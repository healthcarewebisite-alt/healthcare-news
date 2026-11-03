<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService) {}

    public function index(Request $request)
    {
        $query = Article::with(['category', 'author']);

        if ($request->filled('q')) {
            $query->where('title', 'like', '%'.$request->input('q').'%');
        }
        if ($request->filled('status')) {
            $request->validate([
                'status' => ['in:draft,in_review,scheduled,published,rejected,archived'],
            ]);
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('kategori')) {
            $request->validate(['kategori' => ['integer', 'exists:categories,id']]);
            $query->where('category_id', $request->integer('kategori'));
        }

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
        $imagePath = $request->hasFile('featured_image')
            ? $this->imageUploadService->uploadAsWebp($request->file('featured_image'), 'articles')
            : null;

        try {
            DB::transaction(function () use ($validated, $request, $imagePath) {
                $article = new Article($validated);
                $article->author_id = $request->user()->id;
                $article->status = 'draft';
                $article->featured_image = $imagePath;
                $article->save();

                if (! empty($validated['tags'])) {
                    $article->tags()->sync($validated['tags']);
                }
            });
        } catch (\Throwable $exception) {
            $this->imageUploadService->delete($imagePath);
            throw $exception;
        }

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(Request $request, Article $article)
    {
        $this->authorizeArticleEditing($request->user(), $article);

        $categories = Category::active()->ordered()->get();
        $tags = Tag::orderBy('name')->get();
        $article->load('tags');

        return view('admin.articles.edit', compact('article', 'categories', 'tags'));
    }

    public function preview(Request $request, Article $article)
    {
        $this->authorizeArticleEditing($request->user(), $article);
        $article->load(['category', 'author', 'tags']);

        return view('admin.articles.preview', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeArticleEditing($request->user(), $article);
        $validated = $this->validateArticle($request, $article->id);
        $oldImagePath = $article->featured_image;
        $newImagePath = $request->hasFile('featured_image')
            ? $this->imageUploadService->uploadAsWebp($request->file('featured_image'), 'articles')
            : null;

        try {
            DB::transaction(function () use ($validated, $article, $newImagePath) {
                if ($newImagePath) {
                    $validated['featured_image'] = $newImagePath;
                }

                $article->update($validated);
                $article->tags()->sync($validated['tags'] ?? []);
            });
        } catch (\Throwable $exception) {
            $this->imageUploadService->delete($newImagePath);
            throw $exception;
        }

        if ($newImagePath) {
            $this->imageUploadService->delete($oldImagePath);
        }

        return redirect()->route('admin.articles.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Request $request, Article $article)
    {
        $this->authorizeArticleEditing($request->user(), $article);

        abort_unless(
            $request->user()->isEditor() || in_array($article->status, ['draft', 'rejected'], true),
            403,
            'Artikel yang sudah diajukan atau diterbitkan tidak dapat dihapus oleh penulis.'
        );

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
            'url' => asset('storage/'.$path),
        ]);
    }

    public function submitForReview(Request $request, Article $article)
    {
        abort_unless(in_array($request->user()->role, ['author', 'editor', 'super_admin'], true), 403);
        $this->authorizeArticleEditing($request->user(), $article);

        abort_unless(in_array($article->status, ['draft', 'rejected'], true), 409, 'Hanya draft atau artikel yang ditolak dapat diajukan untuk review.');

        $article->update([
            'status' => 'in_review',
            'submitted_for_review_at' => now(),
            'reviewed_at' => null,
            'reviewed_by' => null,
            'review_notes' => null,
        ]);

        return back()->with('success', 'Artikel berhasil diajukan untuk review editor.');
    }

    public function publish(Request $request, Article $article)
    {
        abort_unless($article->status === 'in_review', 409, 'Hanya artikel yang sedang direview dapat diterbitkan.');

        $article->update([
            'status' => 'published',
            'published_at' => now(),
            'reviewed_at' => now(),
            'reviewed_by' => $request->user()->id,
            'review_notes' => null,
        ]);

        return back()->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function schedule(Request $request, Article $article)
    {
        abort_unless($article->status === 'in_review', 409, 'Hanya artikel yang sedang direview dapat dijadwalkan.');

        $validated = $request->validate([
            'published_at' => ['required', 'date', 'after:now'],
        ]);

        $article->update([
            'status' => 'scheduled',
            'published_at' => $validated['published_at'],
            'reviewed_at' => now(),
            'reviewed_by' => $request->user()->id,
            'review_notes' => null,
        ]);

        return back()->with('success', 'Artikel berhasil dijadwalkan.');
    }

    public function reject(Request $request, Article $article)
    {
        abort_unless($article->status === 'in_review', 409, 'Hanya artikel yang sedang direview dapat ditolak.');

        $validated = $request->validate([
            'review_notes' => ['required', 'string', 'max:2000'],
        ]);

        $article->update([
            'status' => 'rejected',
            'reviewed_at' => now(),
            'reviewed_by' => $request->user()->id,
            'review_notes' => $validated['review_notes'],
        ]);

        return back()->with('success', 'Artikel ditolak dan dikembalikan kepada penulis.');
    }

    public function archive(Article $article)
    {
        abort_unless($article->status === 'published', 409, 'Hanya artikel terbit yang dapat diarsipkan.');

        $article->update(['status' => 'archived']);

        return back()->with('success', 'Artikel berhasil diarsipkan.');
    }

    private function authorizeArticleEditing(User $user, Article $article): void
    {
        if ($user->isEditor()) {
            return;
        }

        abort_unless($article->author_id === $user->id, 403, 'Anda hanya dapat mengakses artikel sendiri.');
        abort_unless(in_array($article->status, ['draft', 'rejected'], true), 403, 'Artikel yang sudah diajukan untuk review tidak dapat diedit.');
    }

    protected function validateArticle(Request $request, ?int $articleId = null): array
    {
        if ($request->filled('slug')) {
            $request->merge(['slug' => Str::slug($request->input('slug'))]);
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('articles', 'slug')->ignore($articleId)],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string', 'max:100000'],
            'category_id' => ['required', 'exists:categories,id'],
            'featured_image' => ['nullable', 'image', 'max:5120', 'mimes:jpg,jpeg,png,webp'],
            'featured_image_alt' => ['nullable', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:255'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', 'exists:tags,id'],
        ]);

        if ($request->user()->isEditor()) {
            $validated['is_headline'] = $request->boolean('is_headline');
            $validated['is_trending'] = $request->boolean('is_trending');
            $validated['is_breaking'] = $request->boolean('is_breaking');
            $validated['is_featured'] = $request->boolean('is_featured');
        }

        if (blank($validated['slug'] ?? null)) {
            unset($validated['slug']);
        }

        return $validated;
    }
}
