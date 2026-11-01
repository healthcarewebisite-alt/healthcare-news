<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Infographic;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class InfographicController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function index()
    {
        $infographics = Infographic::with('category')->latest()->paginate(15);

        return view('admin.infographics.index', compact('infographics'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();

        return view('admin.infographics.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateInfographic($request);

        $validated['image'] = $this->imageUploadService->uploadAsWebp($request->file('image'), 'infographics');

        Infographic::create($validated);

        return redirect()->route('admin.infographics.index')->with('success', 'Infografis berhasil ditambahkan.');
    }

    public function edit(Infographic $infographic)
    {
        $categories = Category::active()->ordered()->get();

        return view('admin.infographics.edit', compact('infographic', 'categories'));
    }

    public function update(Request $request, Infographic $infographic)
    {
        $validated = $this->validateInfographic($request, false);

        if ($request->hasFile('image')) {
            $this->imageUploadService->delete($infographic->image);
            $validated['image'] = $this->imageUploadService->uploadAsWebp($request->file('image'), 'infographics');
        }

        $infographic->update($validated);

        return redirect()->route('admin.infographics.index')->with('success', 'Infografis berhasil diperbarui.');
    }

    public function destroy(Infographic $infographic)
    {
        $this->imageUploadService->delete($infographic->image);
        $infographic->delete();

        return back()->with('success', 'Infografis berhasil dihapus.');
    }

    protected function validateInfographic(Request $request, bool $imageRequired = true): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:5120'],
        ]);

        $validated['category_id'] = $validated['category_id'] ?: null;
        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['image']); // gambar ditangani terpisah (upload WebP)

        return $validated;
    }
}
