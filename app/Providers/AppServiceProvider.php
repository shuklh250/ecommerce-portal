<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

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
        View::share('categories', Category::whereHas('subcategories', function ($query) {
            $query->whereHas('products'); // subcategory ke andar products hone chahiye
        })->with(['subcategories' => function ($query) {
            $query->whereHas('products'); // sirf wahi subcategories jisme products ho
        }])->where('status', 1)->get());
    }
}
