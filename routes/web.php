<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZodiacController;

// Página de inicio personalizada
Route::get('/', function () {
    return view('home');
});

// Rutas del Zodiac Web
Route::get('/zodiac', [ZodiacController::class, 'showForm'])->name('zodiac.form');
Route::post('/zodiac', [ZodiacController::class, 'showResult'])->name('zodiac.result');
