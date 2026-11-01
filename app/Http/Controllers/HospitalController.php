<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(Request $request)
    {
        $query = Hospital::active();

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('kota')) {
            $query->where('city', $request->kota);
        }

        if ($request->boolean('bpjs')) {
            $query->where('is_bpjs', true);
        }

        $hospitals = $query->orderByDesc('rating')->paginate(12)->withQueryString();
        $cities = Hospital::active()->distinct()->pluck('city');

        return view('hospitals.index', compact('hospitals', 'cities'));
    }

    public function show(string $slug)
    {
        $hospital = Hospital::active()->where('slug', $slug)->with('doctors')->firstOrFail();

        return view('hospitals.show', compact('hospital'));
    }
}
