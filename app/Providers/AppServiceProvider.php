<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('host', function ($url) {
            return "<?php echo str_replace('www.', '', parse_url($url, PHP_URL_HOST)); ?>";
        });

        Blade::if('admin', function () {
            return auth()->user()->is_admin;
        });

        Blade::if('employee', function () {
            return ! auth()->user()->is_admin;
        });

        Blade::if('routeis', function ($route) {
            return Route::currentRouteName() === $route;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
