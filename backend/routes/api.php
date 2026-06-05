<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProxyController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('proxies', ProxyController::class);
Route::post('proxies/{proxy}/check', [ProxyController::class, 'check']);
