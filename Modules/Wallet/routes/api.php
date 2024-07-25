<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Wallet\App\Http\Controllers\Management\WalletController;

Route::prefix('management')->group(function () {
    Route::apiResource("wallets", WalletController::class);
});
