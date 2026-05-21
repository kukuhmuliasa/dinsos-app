<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\SecureFileController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/berita', [HomeController::class, 'posts'])->name('posts.index');
Route::get('/berita/{slug}', [HomeController::class, 'showPost'])->name('post.show');
Route::get('/unduhan', [HomeController::class, 'documents'])->name('documents.index');

Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');

Route::get('/profil/visi-misi', [ProfileController::class, 'visimisi'])->name('profile.visimisi');
Route::get('/profil/struktur-organisasi', [ProfileController::class, 'structure'])->name('profile.structure');

Route::prefix('layanan')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('layanan.index');
    Route::get('/cek-kelayakan', [ServiceController::class, 'simulator'])->name('layanan.simulator');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('layanan.show');
});

Route::prefix('ppid')->group(function () {
    Route::get('/pengaduan', [DocumentController::class, 'pengaduan'])->name('documents.pengaduan');
    Route::get('/laporan', [DocumentController::class, 'laporan'])->name('documents.laporan');
    Route::get('/jumlah-pemohon', [DocumentController::class, 'pemohon'])->name('documents.pemohon');
    Route::get('/geospasial', [DocumentController::class, 'geospasial'])->name('documents.geospasial');
});

// Secure file serving — files stored in storage/app/ are served through this route
Route::get('/file/{path}', [SecureFileController::class, 'serve'])
    ->where('path', '.*')
    ->name('secure.file');