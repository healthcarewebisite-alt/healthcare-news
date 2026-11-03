<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class RubricController extends Controller
{
    private const RUBRICS = [
        'pharmacy' => ['name' => 'Pharmacy', 'slugs' => ['pharmacy', 'farmasi']],
        'medical-devices' => ['name' => 'Medical Devices', 'slugs' => ['medical-devices', 'medical-device', 'alat-kesehatan']],
        'lifestyle' => ['name' => 'Lifestyle', 'slugs' => ['lifestyle', 'gaya-hidup']],
        'people' => ['name' => 'People', 'slugs' => ['people', 'tokoh']],
        'digital-cover' => ['name' => 'Digital Cover', 'slugs' => ['digital-cover', 'sampul-digital']],
    ];

    public function show(string $slug)
    {
        abort_unless(isset(self::RUBRICS[$slug]), 404);

        $rubric = self::RUBRICS[$slug];
        $category = Category::active()->whereIn('slug', $rubric['slugs'])->first();

        $articles = Article::published()
            ->when($category, fn ($query) => $query->where('category_id', $category->id), fn ($query) => $query->whereRaw('1 = 0'))
            ->with(['category', 'author'])
            ->latest()
            ->paginate(12);

        return view('news.rubric', compact('rubric', 'articles'));
    }
}
