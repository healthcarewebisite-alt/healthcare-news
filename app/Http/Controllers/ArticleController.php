<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /** Listing berita per kategori, mendukung pencarian & filter */
    public function index(Request $request)
    {
        $query = Article::published()->with(['category', 'author']);

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->filled('kategori')) {
            $query->inCategory($request->kategori);
        }

        $articles = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::active()->ordered()->get();

        return view('news.index', compact('articles', 'categories'));
    }

    public function byCategory(string $slug, Request $request)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::published()
            ->where('category_id', $category->id)
            ->with(['category', 'author'])
            ->latest()
            ->paginate(12);

        $categories = Category::active()->ordered()->get();

        return view('news.category', compact('category', 'articles', 'categories'));
    }

    /** Halaman detail artikel */
    public function show(string $slug)
    {
        $article = Article::published()
            ->with(['category', 'author', 'tags', 'approvedComments.replies', 'approvedComments.user'])
            ->where('slug', $slug)
            ->firstOrFail();

        $article->incrementViews();

        $relatedArticles = Article::published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest()
            ->limit(4)
            ->get();

        $popularArticles = Article::published()->popular()->limit(5)->get();

        return view('news.show', compact('article', 'relatedArticles', 'popularArticles'));
    }

    /** Simpan komentar dari publik (butuh moderasi sebelum tampil) */
    public function storeComment(Request $request, Article $article)
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'min:3', 'max:2000'],
            'guest_name' => ['required_without:user_id', 'string', 'max:100'],
            'guest_email' => ['required_without:user_id', 'email', 'max:150'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        Comment::create([
            'article_id' => $article->id,
            'user_id' => auth()->id(),
            'guest_name' => auth()->check() ? null : $validated['guest_name'],
            'guest_email' => auth()->check() ? null : $validated['guest_email'],
            'body' => $validated['body'],
            'parent_id' => $validated['parent_id'] ?? null,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Komentar Anda berhasil dikirim dan sedang menunggu moderasi.');
    }
}
