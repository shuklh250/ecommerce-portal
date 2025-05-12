<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Support\Facades\Schema;

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
        if (Schema::hasTable('categories') && Schema::hasTable('subcategories') && Schema::hasTable('products')) {
            $categories = Category::whereHas('subcategories', function ($query) {
                $query->whereHas('products');
            })->with(['subcategories' => function ($query) {
                $query->whereHas('products');
            }])->where('status', 1)->get();

            View::share('categories', $categories);
        }
    }
}
