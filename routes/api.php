<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Padrao\Models\Auth\AuthController;
use Padrao\Models\CadUsuario\CadUsuarioController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('me', [AuthController::class, 'me'])->name('me')->middleware('auth:sanctum');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('register', [CadUsuarioController::class, 'store']);
