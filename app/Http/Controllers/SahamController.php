<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Saham;

class SahamController extends Controller
{
    public function index()
    {
        $saham = Saham::all();
        return view('admin.data-saham', compact('saham'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_saham' => 'required|string|max:10|unique:sahams,kode_saham',
            'nama_saham' => 'required|string|max:100',
            'per' => 'required|numeric',
            'roe' => 'required|numeric',
            'volume' => 'required|numeric',
            'market_cap' => 'required|numeric',
        ]);

        $saham = Saham::create([
            'kode_saham' => $request->kode_saham,
            'nama_saham' => $request->nama_saham,
            'per' => $request->per,
            'roe' => $request->roe,
            'volume' => $request->volume,
            'market_cap' => $request->market_cap,
        ]);

        // 🔥 Jalankan fuzzifikasi langsung setelah simpan saham
        $saham->prosesFuzzy();

        return redirect()->route('admin.data-saham')
            ->with('success', 'Data saham berhasil ditambahkan & sudah difuzzifikasi.');
    }


    public function destroy($id)
    {
        $saham = Saham::findOrFail($id);
        $saham->delete();

        return redirect()->route('admin.data-saham')->with('success', 'Data saham berhasil dihapus.');
    }
}
