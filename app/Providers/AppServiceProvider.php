<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        // Set the default string length for database migrations.
        // @see https://laravel.com/docs/5.4/migrations#indexes
        Schema::defaultStringLength(191);

        // Configure the Bcrypt hasher to use a cost factor
        // of 12 instead of the default value of 10.
        app('hash')->setRounds(12);
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
