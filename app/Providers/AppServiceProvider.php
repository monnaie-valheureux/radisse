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

        // Configure the Bcrypt hasher to use a custom cost factor.
        app('hash')->setRounds(config('hashing.bcrypt_cost'));

        \Illuminate\Support\Facades\Blade::directive('errorhandling', function ($expression) {
            // return "@include('errors.handling', ['item' => '{$expression}'])";

            return "<?php echo \$__env->make(
                'errors.handling',
                ['item' => {$expression}]
            )->render(); ?>";
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
