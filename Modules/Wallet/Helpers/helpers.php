<?php

use Modules\Wallet\Repository\Contracts\WalletRepository;

if (!function_exists('walletRepo')) {
    /**
     * Get the Wallet Repository.
     *
     * @return WalletRepository
     */
    function walletRepo(): WalletRepository
    {
        return resolve(WalletRepository::class);
    }
}
