<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/management', [App\Http\Controllers\ManagementController::class, 'index'])->name('management');
Route::get('/presensi', [App\Http\Controllers\PresensiController::class, 'index'])->name('presensi');
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');