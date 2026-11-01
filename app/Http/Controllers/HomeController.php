<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Infographic;
use App\Models\Video;

class HomeController extends Controller
{
    /**
     * Halaman utama - menyusun semua section sesuai
     * "Struktur Homepage" pada dokumen konsep Healthcare.id:
     * Header > Breaking News > Headline+Trending > Kategori > Berita Terbaru
     * > Featured Story > Health Tips > Research/Technology > Video
     * > Infografis > Hospital Directory > Doctor Directory > Newsletter > Footer
     */
    public function index()
    {
        $breakingNews = Article::published()->breaking()->latest()->limit(5)->get();

        $headline = Article::published()->headline()->with(['category', 'author'])->latest()->first();

        $trending = Article::published()->trending()
            ->with('category')
            ->latest()
            ->limit(4)
            ->get();

        $categories = Category::active()->ordered()->limit(6)->get();

        $latestArticles = Article::published()
            ->with(['category', 'author'])
            ->latest()
            ->limit(8)
            ->get();

        $featuredArticle = Article::published()->featured()->with('category')->latest()->first();

        $healthTipsCategory = Category::where('slug', 'health-tips')->first();
        $healthTips = $healthTipsCategory
            ? Article::published()->where('category_id', $healthTipsCategory->id)->with('category')->latest()->limit(4)->get()
            : collect();

        $research = Article::published()->inCategory('research')->with('category')->latest()->limit(3)->get();
        $technology = Article::published()->inCategory('health-technology')->with('category')->latest()->limit(3)->get();

        $videos = Video::active()->latest()->limit(4)->get();

        $infographics = Infographic::active()->latest()->limit(3)->get();

        $hospitals = Hospital::active()->orderByDesc('rating')->limit(6)->get();

        $doctors = Doctor::active()->with('hospital')->limit(6)->get();

        return view('pages.home', compact(
            'breakingNews', 'headline', 'trending', 'categories',
            'latestArticles', 'featuredArticle', 'healthTips',
            'research', 'technology', 'videos', 'infographics',
            'hospitals', 'doctors'
        ));
    }
}
