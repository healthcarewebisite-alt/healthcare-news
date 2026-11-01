<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Services\ImageUploadService;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function __construct(protected ImageUploadService $imageUploadService)
    {
    }

    public function index(Request $request)
    {
        $query = Doctor::with('hospital');
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        $doctors = $query->latest()->paginate(15)->withQueryString();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function create()
    {
        $hospitals = Hospital::active()->orderBy('name')->get();

        return view('admin.doctors.create', compact('hospitals'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateDoctor($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->imageUploadService->uploadAsWebp($request->file('photo'), 'doctors', 800);
        }

        Doctor::create($validated);

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil ditambahkan.');
    }

    public function edit(Doctor $doctor)
    {
        $hospitals = Hospital::active()->orderBy('name')->get();

        return view('admin.doctors.edit', compact('doctor', 'hospitals'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $this->validateDoctor($request);

        if ($request->hasFile('photo')) {
            $this->imageUploadService->delete($doctor->photo);
            $validated['photo'] = $this->imageUploadService->uploadAsWebp($request->file('photo'), 'doctors', 800);
        }

        $doctor->update($validated);

        return redirect()->route('admin.doctors.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Doctor $doctor)
    {
        $this->imageUploadService->delete($doctor->photo);
        $doctor->delete();

        return back()->with('success', 'Data dokter berhasil dihapus.');
    }

    protected function validateDoctor(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'specialty' => ['required', 'string', 'max:150'],
            'hospital_id' => ['nullable', 'exists:hospitals,id'],
            'str_number' => ['nullable', 'string', 'max:50'],
            'bio' => ['nullable', 'string'],
            'years_experience' => ['nullable', 'integer', 'min:0'],
            'photo' => ['nullable', 'image', 'max:3072'],
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['hospital_id'] = $validated['hospital_id'] ?: null;

        return $validated;
    }
}
