<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saham;
use App\Models\Fuzzifikasi;
use App\Models\HasilFuzzy;

class RekomendasiController extends Controller
{
    public function index()
    {
        // Ambil hasil fuzzy beserta relasi saham
        $hasil = HasilFuzzy::with('saham')->get();
        return view('admin.rekomendasi', compact('hasil'));
    }

    public function downloadPDF()
    {
        $hasil = HasilFuzzy::with('saham')->get();

        // Pastikan kamu sudah install dompdf: composer require barryvdh/laravel-dompdf
        $pdf = \PDF::loadView('admin.rekomendasi_pdf', compact('hasil'));
        return $pdf->download('hasil_rekomendasi.pdf');
    }
}
