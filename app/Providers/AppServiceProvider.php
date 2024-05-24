<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        Model::shouldBeStrict(App::isLocal());
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $view->with('shareCategories', Category::all());
        });
    }
}
