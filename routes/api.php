<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('absensi', [App\Http\Controllers\ManagementController::class, 'getAbsensi'])->name('absensi');
Route::post('recap-all', [App\Http\Controllers\RecapController::class, 'getRecap'])->name('recap-all');