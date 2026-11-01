<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\NewsletterSubscriber;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_articles' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
            'total_views' => Article::sum('views_count'),
            'total_hospitals' => Hospital::count(),
            'total_doctors' => Doctor::count(),
            'total_subscribers' => NewsletterSubscriber::count(),
            'pending_comments' => Comment::where('status', 'pending')->count(),
        ];

        $recentArticles = Article::with(['category', 'author'])->latest()->limit(6)->get();
        $popularArticles = Article::published()->popular()->limit(5)->get();
        $recentComments = Comment::with(['article', 'user'])->latest()->limit(6)->get();

        // Statistik artikel per bulan (6 bulan terakhir) untuk chart
        $articlesPerMonth = Article::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        return view('admin.dashboard', compact(
            'stats', 'recentArticles', 'popularArticles', 'recentComments', 'articlesPerMonth'
        ));
    }
}
