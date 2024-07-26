<?php

use Modules\Gateway\Drivers\Paypal\Paypal;

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
    ],
    'map' => [
        'paypal' => Paypal::class,
    ]
];
