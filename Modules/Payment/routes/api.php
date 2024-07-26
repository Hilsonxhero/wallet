<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Payment\App\Http\Controllers\PaymentController;

Route::prefix('application')->group(function () {
    Route::get("purchase/payment/confirmation/{id}", [PaymentController::class, 'confirmation']);
});
