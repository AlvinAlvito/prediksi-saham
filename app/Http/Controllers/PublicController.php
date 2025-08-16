<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saham;
use App\Models\HasilFuzzy;

class PublicController extends Controller
{
    /**
     * Halaman utama untuk user publik (menampilkan semua saham + rekomendasi).
     */
    public function index()
    {
        // Ambil semua data saham
        $saham = Saham::all();

        // Ambil semua hasil rekomendasi (join dengan saham)
        $rekomendasi = HasilFuzzy::with('saham')->get();

        return view('login', compact('saham', 'rekomendasi'));
    }

    public function getSaham($id)
    {
        // Ambil data saham dengan relasi rekomendasi
        $saham = Saham::with('hasilFuzzy')->findOrFail($id);

        return response()->json([
            'saham' => [
                'id' => $saham->id,
                'kode_saham' => $saham->kode_saham,
                'nama_saham' => $saham->nama_saham,
                'per' => $saham->per,
                'roe' => $saham->roe,
                'volume' => $saham->volume,
                'market_cap' => $saham->market_cap,
            ],
            'rekomendasi' => $saham->hasilFuzzy->map(function ($r) {
                return [
                    'id' => $r->id,
                    'kategori' => $r->kategori,
                    'persentase' => $r->persentase,
                    'saham' => [
                        'kode_saham' => $r->saham->kode_saham,
                        'nama_saham' => $r->saham->nama_saham,
                    ]
                ];
            })
        ]);
    }
}
