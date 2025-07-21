<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

Route::prefix('barangs')->middleware('apikey')->group(function () {
    Route::get('/', [BarangController::class, 'index']);
    Route::post('/decrypt', [BarangController::class, 'decryptResponse']);
    Route::get('{id}', [BarangController::class, 'show']);
    Route::post('/', [BarangController::class, 'store']);
    Route::put('{id}', [BarangController::class, 'update']);
    Route::delete('{id}', [BarangController::class, 'destroy']);
});