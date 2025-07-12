<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/pelanggan', App\Http\Controllers\Api\PelangganController::class);
Route::get('/pelanggan-active', [App\Http\Controllers\Api\PelangganController::class, 'active']);

Route::apiResource('/membership', App\Http\Controllers\Api\MembershipController::class);
Route::apiResource('/kelas-gym', App\Http\Controllers\Api\KelasGymController::class);
Route::apiResource('/booking-kelas', App\Http\Controllers\Api\BookingKelasController::class);