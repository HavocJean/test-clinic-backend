<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\SpecialtyController;

Route::post('/login', 'AuthController@login');

Route::middleware('jwt.auth')->group(function () {
    Route::post('/logout', 'AuthController@logout');

    Route::prefix('user')->group(function () {
        Route::get('/history', 'UserHistoryController@index');
        Route::post('/history', 'UserHistoryController@store');
        Route::get('/history/{id}', 'UserHistoryController@show');
        Route::put('/history/{id}', 'UserHistoryController@update');
        Route::delete('/history/{id}', 'UserHistoryController@destroy');
    });

    Route::get('/specialties', 'SpecialtyController@index');
    Route::get('/regionals', 'RegionalController@index');
});