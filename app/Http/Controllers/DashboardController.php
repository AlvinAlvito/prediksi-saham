<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saham;
use App\Models\Fuzzifikasi;
use App\Models\HasilFuzzy;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Distribusi kategori hasil fuzzy (Pie Chart)
        $kategoriDistribusi = HasilFuzzy::selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        // 2. Top 10 saham berdasarkan nilai fuzzy (Bar Chart)
        $topSaham = HasilFuzzy::with('saham')
            ->orderByDesc('persentase')
            ->take(10)
            ->get();

        // 3. Radar chart → ambil semua saham, tampilkan beberapa metrik
        $radarSaham = Saham::select('kode_saham', 'per', 'roe', 'volume', 'market_cap')
            ->take(5) // ambil 5 dulu biar tidak terlalu banyak
            ->get();

        // 4. Stacked Bar Chart → ambil nilai fuzzifikasi untuk setiap saham
        $fuzzifikasi = Fuzzifikasi::with('saham')->get();

        return view('admin.index', compact(
            'kategoriDistribusi',
            'topSaham',
            'radarSaham',
            'fuzzifikasi'
        ));
    }
}
