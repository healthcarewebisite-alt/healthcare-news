<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function index(Request $request)
    {
        $query = Hospital::query();
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        $hospitals = $query->latest()->paginate(15)->withQueryString();

        return view('admin.hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        return view('admin.hospitals.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateHospital($request);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->imageUploadService->uploadAsWebp($request->file('logo'), 'hospitals/logo');
        }
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $this->imageUploadService->uploadAsWebp($request->file('cover_image'), 'hospitals/cover');
        }
        if ($request->filled('facilities')) {
            $validated['facilities'] = array_filter(array_map('trim', explode(',', $request->facilities)));
        }

        Hospital::create($validated);

        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah sakit berhasil ditambahkan.');
    }

    public function edit(Hospital $hospital)
    {
        return view('admin.hospitals.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $validated = $this->validateHospital($request);

        if ($request->hasFile('logo')) {
            $this->imageUploadService->delete($hospital->logo);
            $validated['logo'] = $this->imageUploadService->uploadAsWebp($request->file('logo'), 'hospitals/logo');
        }
        if ($request->hasFile('cover_image')) {
            $this->imageUploadService->delete($hospital->cover_image);
            $validated['cover_image'] = $this->imageUploadService->uploadAsWebp($request->file('cover_image'), 'hospitals/cover');
        }
        if ($request->filled('facilities')) {
            $validated['facilities'] = array_filter(array_map('trim', explode(',', $request->facilities)));
        }

        $hospital->update($validated);

        return redirect()->route('admin.hospitals.index')->with('success', 'Rumah sakit berhasil diperbarui.');
    }

    public function destroy(Hospital $hospital)
    {
        $this->imageUploadService->delete($hospital->logo);
        $this->imageUploadService->delete($hospital->cover_image);
        $hospital->delete();

        return back()->with('success', 'Rumah sakit berhasil dihapus.');
    }

    protected function validateHospital(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:100'],
            'province' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['nullable', 'email', 'max:150'],
            'website' => ['nullable', 'url', 'max:255'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'description' => ['nullable', 'string'],
            'logo' => ['nullable', 'image', 'max:3072'],
            'cover_image' => ['nullable', 'image', 'max:5120'],
        ]);

        $validated['is_bpjs'] = $request->boolean('is_bpjs');
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
