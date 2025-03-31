<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\SpecialtyController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::prefix('user')->group(function () {
        Route::get('/history', [UserHistoryController::class, 'index']);
        Route::post('/history', [UserHistoryController::class, 'store']);
        Route::get('/history/{id}', [UserHistoryController::class, 'show']);
        Route::put('/history/{id}', [UserHistoryController::class, 'update']);
        Route::delete('/history/{id}', [UserHistoryController::class, 'destroy']);
    });

    Route::get('/specialties', [SpecialtyController::class, 'index']);
    Route::get('/regionals', [RegionalController::class, 'index']);
});