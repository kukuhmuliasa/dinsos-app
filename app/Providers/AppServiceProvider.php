<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    // Gunakan try-catch agar jika tabel/kolom belum ada, web tidak langsung mati total
    \Illuminate\Support\Facades\View::composer('layouts.app', function ($view) {
        try {
            // Kita coba ambil data tanpa pengurutan kolom 'title' dulu
            $services = \App\Models\Service::all(); 
            $view->with('navServices', $services);
        } catch (\Exception $e) {
            $view->with('navServices', collect());
        }
    });
    }
}