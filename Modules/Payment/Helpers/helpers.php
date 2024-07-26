<?php

use Modules\Payment\Repository\Contracts\PaymentRepository;

if (!function_exists('paymentRepo')) {
    /**
     * Get the Payment Repository.
     *
     * @return PaymentRepository
     */
    function paymentRepo(): PaymentRepository
    {
        return resolve(PaymentRepository::class);
    }
}
