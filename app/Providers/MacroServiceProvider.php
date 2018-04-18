<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * This class loads custom macros.
 */
class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        require_once app_path('macros.php');
    }
}
