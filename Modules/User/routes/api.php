<?php


use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\Auth\RegisteredUserController;
use Modules\User\App\Http\Controllers\Auth\AuthenticatedSessionController;
use Modules\User\App\Http\Controllers\User\UserWalletController;

Route::prefix('application')->group(function () {

    Route::prefix('user')->middleware(['auth:api'])->group(function () {
        Route::get("init", [AuthenticatedSessionController::class, 'init']);
        Route::post("logout", [AuthenticatedSessionController::class, 'logout']);

        Route::get("wallets", [UserWalletController::class, 'index']);
        Route::get("wallets/{id}", [UserWalletController::class, 'show']);
        Route::post("wallets/credit/{id}", [UserWalletController::class, 'credit']);
    });
    Route::prefix('auth')->group(function () {
        Route::post("register", [RegisteredUserController::class, 'store']);
        Route::post("login", [AuthenticatedSessionController::class, 'store']);
    });
});
