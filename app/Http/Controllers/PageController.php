<?php

namespace App\Http\Controllers;

use App\Models\ContentPage;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $contentPage = ContentPage::where('slug', $slug)->firstOrFail();
        $page = $contentPage->toArray();
        $page['paragraphs'] = preg_split('/\R\s*\R/u', trim($contentPage->content), -1, PREG_SPLIT_NO_EMPTY);

        return view('pages.information', compact('page'));
    }
}
