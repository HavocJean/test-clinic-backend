<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\SpecialtyController;

Route::post('/user/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/info', [AuthController::class, 'info']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::prefix('patient')->group(function () {
        Route::get('/patients', [PatientController::class, 'index']);
        Route::get('/info/{id}', [PatientController::class, 'info']);
        Route::post('/register', [PatientController::class, 'register']);
        Route::put('/update/{id}', [PatientController::class, 'update']);
        Route::delete('/delete/{id}', [PatientController::class, 'delete']);

        Route::prefix('history')->group(function () {
            Route::get('/histories', [UserHistoryController::class, 'index']);
            Route::get('/info/{id}', [UserHistoryController::class, 'show']);
            Route::post('/register', [UserHistoryController::class, 'store']);
            Route::put('/update/{id}', [UserHistoryController::class, 'update']);
            Route::delete('/history/{id}', [UserHistoryController::class, 'destroy']);
        });
    });

    Route::get('/specialties', [SpecialtyController::class, 'index']);
    Route::get('/regionals', [RegionalController::class, 'index']);
});