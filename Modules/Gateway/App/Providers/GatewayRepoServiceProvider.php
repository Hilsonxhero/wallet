<?php

namespace Modules\Gateway\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Gateway\Repository\Contracts\GatewayRepository;
use Modules\Gateway\Repository\Eloquent\GatewayRepositoryEloquent;

class GatewayRepoServiceProvider extends ServiceProvider
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
        $this->app->bind(GatewayRepository::class, GatewayRepositoryEloquent::class);
    }
}
