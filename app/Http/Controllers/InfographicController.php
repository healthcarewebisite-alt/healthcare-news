<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Infographic;
use Illuminate\Http\Request;

class InfographicController extends Controller
{
    public function index(Request $request)
    {
        $query = Infographic::active()->with('category');

        if ($request->filled('kategori')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->kategori));
        }

        $infographics = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::active()->ordered()->get();

        return view('infographics.index', compact('infographics', 'categories'));
    }

    public function show(string $slug)
    {
        $infographic = Infographic::active()->where('slug', $slug)->with('category')->firstOrFail();

        $related = Infographic::active()
            ->where('id', '!=', $infographic->id)
            ->when($infographic->category_id, fn ($q) => $q->where('category_id', $infographic->category_id))
            ->latest()
            ->limit(4)
            ->get();

        return view('infographics.show', compact('infographic', 'related'));
    }
}
