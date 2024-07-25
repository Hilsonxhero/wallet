<?php


use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\Auth\RegisteredUserController;
use Modules\User\App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::prefix('application')->group(function () {

    Route::prefix('user')->middleware(['auth:api'])->group(function () {
        Route::get("init", [AuthenticatedSessionController::class, 'init']);
        Route::post("logout", [AuthenticatedSessionController::class, 'logout']);
    });
    Route::prefix('auth')->group(function () {
        Route::post("register", [RegisteredUserController::class, 'store']);
        Route::post("login", [AuthenticatedSessionController::class, 'store']);
    });
});
