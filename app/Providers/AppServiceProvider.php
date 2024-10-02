<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

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
    public function boot()
    {
        if (config('database.default') === 'sqlite') {
            Schema::enableForeignKeyConstraints(); // Habilita las claves foráneas en SQLite
        }
    }
}
