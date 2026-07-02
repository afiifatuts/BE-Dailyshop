<?php

namespace App\Providers;

use App\Interface\StoreBalanceRepositoryInterface;
use App\Interface\UserRepositoryInterface;
use App\Repositories\StoreBalanceRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
           $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
        $this->app->bind(
            \App\Interface\StoreRepositoryInterface::class,
            \App\Repositories\StoreRepository::class
        );
        $this->app->bind(
            StoreBalanceRepositoryInterface::class, StoreBalanceRepository::class
        );
        $this->app->bind(
            \App\Interface\StoreBalanceHistoryInterface::class,
            \App\Repositories\StoreBalanceHistoryRepository::class
        );
        $this->app->bind(
            \App\Interface\WithdrawalInterface::class,
            \App\Repositories\WithdrawalRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
