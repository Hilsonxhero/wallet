<?php

use Modules\Payment\Repository\Contracts\PaymentRepository;
use Modules\Payment\Repository\Contracts\TransactionRepository;

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


if (!function_exists('transactionRepo')) {
    /**
     * Get the Transaction Repository.
     *
     * @return TransactionRepository
     */
    function transactionRepo(): TransactionRepository
    {
        return resolve(TransactionRepository::class);
    }
}
