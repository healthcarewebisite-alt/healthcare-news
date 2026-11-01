<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function index(Request $request)
    {
        $query = Article::with(['category', 'author']);

        if ($request->filled('q')) {
            $query->where('title', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('kategori')) {
            $query->where('category_id', $request->kategori);
        }

        // Author hanya bisa melihat artikelnya sendiri
        if ($request->user()->role === 'author') {
            $query->where('author_id', $request->user()->id);
        }

        $articles = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::active()->ordered()->get();

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        $tags = Tag::orderBy('name')->get();

        return view('admin.articles.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateArticle($request);

        DB::transaction(function () use ($validated, $request) {
            $article = new Article($validated);
            $article->author_id = $request->user()->id;

            if ($request->hasFile('featured_image')) {
                $article->featured_image = $this->imageUploadService->uploadAsWebp(
                    $request->file('featured_image'),
                    'articles'
                );
            }

            if ($validated['status'] === 'published' && empty($validated['published_at'])) {
                $article->published_at = now();
            }

            $article->save();

            if ($request->filled('tags')) {
                $article->tags()->sync($request->input('tags'));
            }
        });

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Article $article)
    {
        $categories = Category::active()->ordered()->get();
        $tags = Tag::orderBy('name')->get();
        $article->load('tags');

        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $this->validateArticle($request, $article->id);

        DB::transaction(function () use ($validated, $request, $article) {
            if ($request->hasFile('featured_image')) {
                $this->imageUploadService->delete($article->featured_image);
                $validated['featured_image'] = $this->imageUploadService->uploadAsWebp(
                    $request->file('featured_image'),
                    'articles'
                );
            }

            if ($validated['status'] === 'published' && ! $article->published_at) {
                $validated['published_at'] = now();
            }

            $article->update($validated);
            $article->tags()->sync($request->input('tags', []));
        });

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Article $article)
    {
        $this->imageUploadService->delete($article->featured_image);
        $article->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Endpoint upload gambar dari dalam Trix editor.
     * Dipanggil via AJAX (lihat resources/js/admin.js).
     * Gambar otomatis dikonversi & disimpan sebagai .webp.
     */
    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:5120', 'mimes:jpg,jpeg,png,webp,gif'],
        ]);

        $path = $this->imageUploadService->uploadAsWebp($request->file('image'), 'editor');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    protected function validateArticle(Request $request, ?int $articleId = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'featured_image' => ['nullable', 'image', 'max:5120', 'mimes:jpg,jpeg,png,webp'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'status' => ['required', 'in:draft,published,archived'],
            'published_at' => ['nullable', 'date'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
        ]);

        // Checkbox yang tidak dicentang tidak dikirim browser, jadi di-set eksplisit
        // agar mencentang lalu meng-uncheck tetap tersimpan sebagai false saat update.
        $validated['is_headline'] = $request->boolean('is_headline');
        $validated['is_trending'] = $request->boolean('is_trending');
        $validated['is_breaking'] = $request->boolean('is_breaking');
        $validated['is_featured'] = $request->boolean('is_featured');

        return $validated;
    }
}
