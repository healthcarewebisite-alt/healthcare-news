<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\NewsletterSubscriber;

class DashboardController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $articlesQuery = Article::query();

        if ($user->role === 'author') {
            $articlesQuery->where('author_id', $user->id);
        }

        $stats = [
            'total_articles' => (clone $articlesQuery)->count(),
            'published_articles' => (clone $articlesQuery)->where('status', 'published')->count(),
            'draft_articles' => (clone $articlesQuery)->where('status', 'draft')->count(),
            'in_review_articles' => (clone $articlesQuery)->where('status', 'in_review')->count(),
            'scheduled_articles' => (clone $articlesQuery)->where('status', 'scheduled')->count(),
            'total_views' => (clone $articlesQuery)->sum('views_count'),
            'total_hospitals' => $user->isEditor() ? Hospital::count() : null,
            'total_doctors' => $user->isEditor() ? Doctor::count() : null,
            'total_subscribers' => $user->isEditor() ? NewsletterSubscriber::count() : null,
            'pending_comments' => $user->isEditor() ? Comment::where('status', 'pending')->count() : null,
        ];

        $recentArticles = (clone $articlesQuery)->with(['category', 'author'])->latest()->limit(6)->get();
        $popularArticles = (clone $articlesQuery)->published()->popular()->limit(5)->get();
        $reviewQueue = $user->isEditor()
            ? Article::with(['category', 'author'])->where('status', 'in_review')->oldest('submitted_for_review_at')->limit(6)->get()
            : collect();
        $pendingComments = $user->isEditor()
            ? Comment::with(['article', 'user'])->where('status', 'pending')->latest()->limit(6)->get()
            : collect();

        // Statistik artikel per bulan (6 bulan terakhir) untuk chart
        $articlesPerMonth = (clone $articlesQuery)->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'stats', 'recentArticles', 'popularArticles', 'reviewQueue', 'pendingComments', 'articlesPerMonth'
        ));
    }
}
