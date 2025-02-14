<?php

namespace App\Providers;

use App\Interfaces\ApiRepositoryInterface;
use App\Interfaces\SMSRepositoryInterface;
use App\Repositories\ApiRepository;
use App\Repositories\SMSRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SMSRepositoryInterface::class, SMSRepository::class);
        $this->app->bind(ApiRepositoryInterface::class,ApiRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
