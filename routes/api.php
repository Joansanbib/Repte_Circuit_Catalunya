<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    // Incidencia Routes
    Route::get('/incidencias', [ApiController::class, 'getAllIncidents'])->middleware('role:admin');
    Route::get('/incidencias/usuari', [ApiController::class, 'getUserIncidents']);
    Route::post('/incidencias', [ApiController::class, 'createIncident']);
    Route::put('/incidencias/{id}', [ApiController::class, 'updateIncident']);
    Route::delete('/incidencias/{id}', [ApiController::class, 'deleteIncident'])->middleware('role:admin');
    Route::get('/incidencias/search', [ApiController::class, 'searchIncidents']); // Search endpoint for Incidencias

    // UsuariResol Routes
    Route::get('/usuari_resols', [ApiController::class, 'indexUsuariResol']);
    Route::post('/usuari_resols', [ApiController::class, 'storeUsuariResol']);
    Route::get('/usuari_resols/{id}', [ApiController::class, 'showUsuariResol']);
    Route::put('/usuari_resols/{id}', [ApiController::class, 'updateUsuariResol']);
    Route::delete('/usuari_resols/{id}', [ApiController::class, 'destroyUsuariResol']);
    Route::get('/usuari_resols/search', [ApiController::class, 'searchUsuariResol']); // Search endpoint for UsuariResol

    // Usuari (User) Routes
    Route::get('/users/search', [ApiController::class, 'searchUsers']); // Search endpoint for Users

    // Zona (Zone) Routes
    Route::get('/zones/search', [ApiController::class, 'searchZones']); // Search endpoint for Zones
});
