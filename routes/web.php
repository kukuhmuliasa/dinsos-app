<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/berita', [HomeController::class, 'posts'])->name('posts.index');
Route::get('/layanan', [HomeController::class, 'services'])->name('services.index');
Route::get('/unduhan', [HomeController::class, 'documents'])->name('documents.index');
Route::get('/berita/{slug}', [HomeController::class, 'showPost'])->name('post.show');
Route::get('/', [HomeController::class, 'index']);
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');