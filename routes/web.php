<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SahamController;
use App\Http\Controllers\FuzzyfikasiController;
use App\Http\Controllers\RekomendasiController;

// ===================
// Halaman Login
// ===================
Route::get('/', function () {
    return view('login');
})->name('login');

// ===================
// Proses Login Manual
// ===================
Route::post('/', function (Request $request) {
    $username = $request->username;
    $password = $request->password;

    if ($username === 'admin' && $password === '123') {
        session(['is_admin' => true]);
        return redirect('/admin');
    }

    return back()->withErrors(['login' => 'Username atau Password salah!']);
})->name('login.proses');

// ===================
// Logout
// ===================
Route::get('/logout', function () {
    session()->forget('is_admin');
    return redirect('/');
})->name('logout');

// ===================
// Dashboard Admin
// ===================
Route::get('/admin', function () {
    if (!session('is_admin')) {
        return redirect('/');
    }
    return view('admin.index');
})->name('dashboard');

// ===================
// CRUD Saham
// ===================
Route::get('/admin/data-saham', function () {
    if (!session('is_admin')) return redirect('/');
    return app(SahamController::class)->index();
})->name('admin.data-saham');

Route::post('/admin/data-saham', function (Request $request) {
    if (!session('is_admin')) return redirect('/');
    return app(SahamController::class)->store($request);
})->name('admin.data-saham.store');

Route::delete('/admin/data-saham/{id}', function ($id) {
    if (!session('is_admin')) return redirect('/');
    return app(SahamController::class)->destroy($id);
})->name('admin.data-saham.destroy');


// ===================
// Fuzzifikasi
// ===================
Route::get('/admin/fuzzifikasi', function () {
    if (!session('is_admin')) return redirect('/');
    return app(FuzzyfikasiController::class)->index();
})->name('fuzzifikasi');

// ===================
// Rekomendasi Saham
// ===================
Route::get('/admin/rekomendasi', function () {
    if (!session('is_admin')) return redirect('/');
    return app(RekomendasiController::class)->index();
})->name('admin.rekomendasi');
Route::get('/admin/rekomendasi/download', [RekomendasiController::class, 'downloadPDF'])->name('rekomendasi.download');


