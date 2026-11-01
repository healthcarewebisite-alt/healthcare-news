<?php

namespace App\Http\Controllers;

class CalculatorController extends Controller
{
    /**
     * Halaman Health Calculator sesuai "Fitur Unggulan" pada dokumen konsep:
     * BMI, kebutuhan kalori, usia kehamilan, dll.
     * Semua perhitungan dilakukan di sisi client (Alpine.js) - tidak perlu request ke server.
     */
    public function index()
    {
        return view('pages.calculator');
    }
}
