<?php

use Modules\Gateway\Drivers\Paypal\Paypal;
use Modules\Gateway\Drivers\PerfectMoney\PerfectMoney;
use Modules\Gateway\Drivers\WebMoney\WebMoney;

return [
    'name' => 'Gateway',
    'default' => 'paypal',
    'drivers' => [

        'paypal' => [
            'PurchaseUrl' => config('services.gateways.paypal.PurchaseUrl'),
            'currency' => 'USD',
            'id' => config('services.gateways.paypal.id'),
            'callbackUrl' => config('services.gateways.paypal.callbackUrl'),
            'description' => 'payment using paypal',
        ],

        'perfectmoney' => [
            'PurchaseUrl' => config('services.gateways.perfectmoney.PurchaseUrl'),
            'currency' => 'USD',
            'id' => config('services.gateways.perfectmoney.id'),
            'callbackUrl' => config('services.gateways.perfectmoney.callbackUrl'),
            'description' => 'payment using perfectmoney',
        ],

        'webmoney' => [
            'PurchaseUrl' => config('services.gateways.webmoney.PurchaseUrl'),
            'currency' => 'USD',
            'id' => config('services.gateways.webmoney.id'),
            'callbackUrl' => config('services.gateways.webmoney.callbackUrl'),
            'description' => 'payment using webmoney',
        ],
    ],
    'map' => [
        'paypal' => Paypal::class,
        'perfectmoney' => PerfectMoney::class,
        'webmoney' => WebMoney::class,
    ]
];
