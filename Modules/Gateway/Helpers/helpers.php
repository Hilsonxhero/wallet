<?php

use Modules\Gateway\Repository\Contracts\GatewayRepository;

if (!function_exists('gatewayRepo')) {
    /**
     * Get the Gateway Repository.
     *
     * @return GatewayRepository
     */
    function gatewayRepo(): GatewayRepository
    {
        return resolve(GatewayRepository::class);
    }
}
