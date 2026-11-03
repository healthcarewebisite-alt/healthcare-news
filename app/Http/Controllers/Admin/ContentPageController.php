<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContentPage;
use Illuminate\Http\Request;

class ContentPageController extends Controller
{
    public function index()
    {
        $pages = ContentPage::orderBy('title')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit(ContentPage $contentPage)
    {
        return view('admin.pages.edit', compact('contentPage'));
    }

    public function update(Request $request, ContentPage $contentPage)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'content' => ['required', 'string', 'max:50000'],
            'email' => ['nullable', 'email', 'max:255'],
            'email_label' => ['nullable', 'string', 'max:100'],
            'address' => ['nullable', 'string', 'max:1000'],
            'phone' => ['nullable', 'string', 'max:50'],
        ]);

        $contentPage->update($validated);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }
}
