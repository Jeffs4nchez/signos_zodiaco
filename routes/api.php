<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZodiacController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas del Servicio de Signos Zodiacales
Route::prefix('zodiac')->group(function () {
    // Obtener signo zodiacal por fecha de nacimiento
    Route::post('/', [ZodiacController::class, 'getZodiac']);
    
    // Obtener todos los signos zodiacales
    Route::get('/signs', [ZodiacController::class, 'getAllSigns']);
    
    // Obtener un signo específico por nombre
    Route::get('/signs/{sign}', [ZodiacController::class, 'getSignByName']);
    
    // Obtener compatibilidad entre dos signos
    Route::post('/compatibility', [ZodiacController::class, 'getCompatibility']);
});
