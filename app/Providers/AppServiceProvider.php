<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('front.layout.header', function ($view) {
            $categories = Category::all();
            $subCategories = SubCategory::all();

            $view->with('categories', $categories);
            $view->with('subCategories', $subCategories);
        });
    }
}
