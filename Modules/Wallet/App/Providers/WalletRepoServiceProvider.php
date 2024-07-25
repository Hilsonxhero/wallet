<?php

namespace Modules\Wallet\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Wallet\Repository\Contracts\WalletRepository;
use Modules\Wallet\Repository\Eloquent\WalletRepositoryEloquent;

class WalletRepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(WalletRepository::class, WalletRepositoryEloquent::class);
    }
}
