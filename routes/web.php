<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;


Route::get('/berita', [HomeController::class, 'posts'])->name('posts.index');
Route::get('/unduhan', [HomeController::class, 'documents'])->name('documents.index');
Route::get('/berita/{slug}', [HomeController::class, 'showPost'])->name('post.show');
Route::get('/', [HomeController::class, 'index']);
Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
Route::get('/search/results', [SearchController::class, 'results'])->name('search.results');
Route::get('/profil/visi-misi', [ProfileController::class, 'visimisi'])->name('profile.visimisi');
Route::get('/profil/struktur-organisasi', [ProfileController::class, 'structure'])->name('profile.structure');
Route::get('/layanan/{slug}', [App\Http\Controllers\ServiceController::class, 'show'])->name('services.show');