<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#Rutas sin auth
Route::get('/index', [Home::class, 'index']);
Route::get('/auth', [Home::class, 'auth'])->rename('login');
