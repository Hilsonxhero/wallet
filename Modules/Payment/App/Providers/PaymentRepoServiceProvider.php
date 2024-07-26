<?php

namespace Modules\Payment\App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Modules\Payment\Repository\Contracts\PaymentRepository;
use Modules\Payment\Repository\Contracts\TransactionRepository;
use Modules\Payment\Repository\Eloquent\PaymentRepositoryEloquent;
use Modules\Payment\Repository\Eloquent\TransactionRepositoryEloquent;

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
        $this->app->bind(TransactionRepository::class, TransactionRepositoryEloquent::class);
    }
}
