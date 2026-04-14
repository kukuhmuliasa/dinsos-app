<?php

namespace App\Providers;

use App\Models\ServiceCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class ViewServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    /**
     * Share service categories with ALL views for the mega menu navigation.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Schema::hasTable('service_categories')) {
                $navCategories = ServiceCategory::where('is_active', true)
                    ->with(['activeServices'])
                    ->orderBy('sort_order')
                    ->get();
            } else {
                $navCategories = collect([]);
            }

            $view->with('navCategories', $navCategories);
        });
    }
}
