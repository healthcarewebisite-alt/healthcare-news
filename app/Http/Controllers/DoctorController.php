<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $query = Doctor::active()->with('hospital');

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('spesialis')) {
            $query->where('specialty', $request->spesialis);
        }

        $doctors = $query->paginate(12)->withQueryString();
        $specialties = Doctor::active()->distinct()->pluck('specialty');

        return view('doctors.index', compact('doctors', 'specialties'));
    }

    public function show(string $slug)
    {
        $doctor = Doctor::active()->where('slug', $slug)->with('hospital')->firstOrFail();

        return view('doctors.show', compact('doctor'));
    }
}
