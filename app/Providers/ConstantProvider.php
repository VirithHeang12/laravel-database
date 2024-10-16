<?php

namespace App\Providers;

use App\Http\Controllers\AboutController;
use Illuminate\Support\ServiceProvider;

class ConstantProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->when(AboutController::class)
            ->needs('$amount')
            ->give(400);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
