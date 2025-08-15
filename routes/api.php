<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientHistoryController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\PatientController;

Route::post('/user/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/info', [AuthController::class, 'show']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::prefix('patient')->group(function () {
        Route::get('/patients', [PatientController::class, 'index']);
        Route::get('/info/{id}', [PatientController::class, 'show']);
        Route::post('/register', [PatientController::class, 'store']);
        Route::put('/update/{id}', [PatientController::class, 'update']);
        Route::delete('/delete/{id}', [PatientController::class, 'destroy']);

        Route::get('/histories', [PatientHistoryController::class, 'index']);
        Route::get('/info/{id}', [PatientHistoryController::class, 'show']);
        Route::post('/register', [PatientHistoryController::class, 'store']);
        Route::put('/update/{id}', [PatientHistoryController::class, 'update']);
        Route::delete('/history/{id}', [PatientHistoryController::class, 'destroy']);
    });

    Route::get('/specialties', [SpecialtyController::class, 'index']);
    Route::get('/regionals', [RegionalController::class, 'index']);
});