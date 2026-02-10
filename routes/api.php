<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;
use App\Http\Controllers\Customer;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#Rutas sin auth
Route::get('/index', [Home::class, 'index']);
Route::post('/auth', [Home::class, 'auth'])->name('login');

#Rutas con auth
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [Home::class, 'logout'])->name('exit');

    #Customers
    Route::get('/customers', [Customer::class, 'index']);
    Route::get('/customers/prospectos', [Customer::class, 'prospectos']);
    Route::post('/customers', [Customer::class, 'store']);
    Route::get('/customers/{id}', [Customer::class, 'show']);
    Route::put('/customers/{id}', [Customer::class, 'update']);
    Route::delete('/customers/{id}', [Customer::class, 'destroy']);
    Route::patch('/customers/{id}/convert', [Customer::class, 'convertToClient']);
});
