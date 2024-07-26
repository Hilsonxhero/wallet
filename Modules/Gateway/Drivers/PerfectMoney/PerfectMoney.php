<?php

namespace Modules\Gateway\Drivers\PerfectMoney;

use Illuminate\Support\Str;
use Modules\Gateway\Abstracts\Driver;
use Modules\Gateway\Enums\GatewayStatus;

class PerfectMoney extends Driver
{

    /**
     * Driver settings
     *
     * @var object
     */
    protected $settings;


    /**
     * @var int
     */
    protected $amount;




    public function purchase($amount, $settings)
    {
        $config = (object) $settings;
        $transactionId =  Str::uuid()->toString();
        $purchase = gatewayRepo()->create([
            "ref_code" =>  $transactionId,
            "reference_code" => rand(1000000, 10000000),
            "status" => GatewayStatus::PENDING->value,
            "callback" => $config->callbackUrl,
            "amount" => $amount,
        ]);
        return $transactionId;
    }
    public function pay($transactionId, $settings)
    {
        $config = (object) $settings;
        $paymentUrl = $config->PurchaseUrl;
        $payUrl = $paymentUrl . $transactionId;
        return $payUrl;
    }
    public function verify()
    {
    }
}
