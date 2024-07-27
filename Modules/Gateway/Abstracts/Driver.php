<?php

namespace Modules\Gateway\Abstracts;

use Modules\Gateway\Contracts\DriverInterface;

abstract class Driver implements DriverInterface
{

    abstract public function purchase($amount, $settings);


    abstract public function pay($transactionId, $settings);


    abstract public function verify();
}
