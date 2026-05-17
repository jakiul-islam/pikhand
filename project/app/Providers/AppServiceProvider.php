<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Admin\web_logo;

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
     *
     *
     *
     *
     */
    public function boot(): void
    {


    //web site icone fetch for golobal
      $webInfo = web_logo::first();
      View::share('webInfo', $webInfo);
    //web site icone fetch for golobal

         Paginator::useBootstrap();
    }
}
