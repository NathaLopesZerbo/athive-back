<?php

use App\Mail\ConviteProfessorMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Padrao\Models\Auth\AuthController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('ativar', [AuthController::class, 'formAtivacao']);
Route::post('ativar', [AuthController::class, 'ativarConta']);
