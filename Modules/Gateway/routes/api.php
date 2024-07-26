<?php


use Illuminate\Support\Facades\Route;
use Modules\Gateway\App\Http\Controllers\GatewayController;

Route::prefix('application')->group(function () {
    Route::prefix('gateway')->middleware(['auth:api'])->group(function () {
        Route::get("detail/{id}", [GatewayController::class, 'show']);
        Route::post("detail/purchase/status/{id}", [GatewayController::class, 'status']);
    });
    Route::get("purchase/{type}/callback", [GatewayController::class, 'callback']);
});
