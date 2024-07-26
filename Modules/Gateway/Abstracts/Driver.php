<?php

namespace Modules\Gateway\Abstracts;

use Modules\Gateway\Contracts\DriverInterface;

abstract class Driver implements DriverInterface
{

    abstract public function purchase($amount, $settings);

    /**
     * Pay the invoice
     *
     * @return RedirectionForm
     */
    abstract public function pay($transactionId, $settings);

    /**
     * Verify the payment
     *
     * @return ReceiptInterface
     */
    abstract public function verify();
}
