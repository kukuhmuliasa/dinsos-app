<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// 1. PINDAHKAN KE PALING ATAS
Route::get('/berita', [HomeController::class, 'posts'])->name('posts.index');

// 2. DISUSUL ROUTE LAINNYA
Route::get('/layanan', [HomeController::class, 'services'])->name('services.index');
Route::get('/unduhan', [HomeController::class, 'documents'])->name('documents.index');
Route::get('/berita/{slug}', [HomeController::class, 'showPost'])->name('post.show');

// 3. BARU ROUTE HOME DI PALING BAWAH
Route::get('/', [HomeController::class, 'index']);