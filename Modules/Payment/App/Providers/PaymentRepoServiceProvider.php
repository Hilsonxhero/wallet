<?php

namespace Modules\Payment\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Payment\Repository\Contracts\PaymentRepository;
use Modules\Payment\Repository\Eloquent\PaymentRepositoryEloquent;

class PaymentRepoServiceProvider extends ServiceProvider
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
        $this->app->bind(PaymentRepository::class, PaymentRepositoryEloquent::class);
    }
}
