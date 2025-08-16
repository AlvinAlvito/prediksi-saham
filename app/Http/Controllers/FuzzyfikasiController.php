<?php

namespace App\Http\Controllers;

use App\Models\Fuzzifikasi;
use Illuminate\Http\Request;

class FuzzyfikasiController extends Controller
{
    public function index()
    {
        // Ambil semua hasil fuzzifikasi dengan relasi saham
        $fuzzifikasi = Fuzzifikasi::with('saham')->get();

        return view('admin.fuzzifikasi', compact('fuzzifikasi'));
    }
}
