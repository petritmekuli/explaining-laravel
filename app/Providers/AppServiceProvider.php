<?php

namespace App\Providers;

use App\Tutorials\Facades\StringModifier;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //If StringModifier has primitive data types you would typically bind it here.
        app()->bind('stringModifier', function(){
            return new StringModifier();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
