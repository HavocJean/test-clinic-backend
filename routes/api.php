<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserHistoryController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

Route::prefix('user')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/history', [UserHistoryController::class, 'index']);
    Route::post('/history', [UserHistoryController::class, 'store']);
    Route::get('/history/{id}', [UserHistoryController::class, 'show']);
    Route::put('/history/{id}', [UserHistoryController::class, 'update']);
    Route::delete('/history/{id}', [UserHistoryController::class, 'destroy']);
});