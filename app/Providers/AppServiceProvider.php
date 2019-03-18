<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;
use App\Hellpers\Hellper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    Schema::defaultStringLength(191);

        Blade::directive('dateInput', function ($expression) {
            $id = Hellper::randomString();
            return '<input id="'.$id.'" type="text" name="'.$expression.'" onload="pageLoaded(dateInput(this))"><script>  $( function() {$( "#'.$id.'" ).datepicker();} );</script>';
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



