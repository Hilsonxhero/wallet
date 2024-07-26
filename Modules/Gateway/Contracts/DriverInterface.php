<?php

namespace Modules\Gateway\Contracts;

interface DriverInterface
{
    public function purchase($amount, $settings);
    public function pay($transactionId, $settings);
    public function verify();
}
