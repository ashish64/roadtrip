<?php

namespace App\Providers;

use App\Repositories\Contracts\TripRepositoryContract;
use App\Repositories\TripRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->bind(TripRepositoryContract::class, TripRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
