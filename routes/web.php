<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;

Route::get('/ppid/dokumen', [DocumentController::class, 'index'])->name('documents.index');

// Beranda
Route::get('/', [HomeController::class, 'index']);

// Berita & Dokumen
Route::get('/berita', [HomeController::class, 'posts'])->name('posts.index');
Route::get('/berita/{slug}', [HomeController::class, 'showPost'])->name('post.show');
Route::get('/unduhan', [HomeController::class, 'documents'])->name('documents.index');

// Pencarian
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');

// Profil
Route::get('/profil/visi-misi', [ProfileController::class, 'visimisi'])->name('profile.visimisi');
Route::get('/profil/struktur-organisasi', [ProfileController::class, 'structure'])->name('profile.structure');

// Layanan (Sistem Statis)
Route::prefix('layanan')->group(function () {
    Route::view('/pkh-bpnt-pbi', 'services.pkh')->name('layanan.pkh');
    Route::view('/pip-kip', 'services.pip')->name('layanan.pip');
    Route::view('/kks', 'services.kks')->name('layanan.kks');
    Route::view('/pajak', 'services.pajak')->name('layanan.pajak');
    Route::view('/rehabilitasi-sosial', 'services.rehab')->name('layanan.rehab');
    Route::view('/jaminan-sosial', 'services.jamsos')->name('layanan.jamsos');
});

Route::prefix('ppid')->group(function () {
    Route::get('/pengaduan', [DocumentController::class, 'pengaduan'])->name('documents.pengaduan');
    Route::get('/laporan', [DocumentController::class, 'laporan'])->name('documents.laporan');
    Route::get('/jumlah-pemohon', [DocumentController::class, 'pemohon'])->name('documents.pemohon');
});