<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\IncidenceController;
use App\Models\User;

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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user', function (Request $request) {
        if ($request->user()->tokenCan('read')) {
            return $request->user();
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // Incidencia Routes
    Route::get('/incidencias', [IncidenceController::class, 'getAllIncidents']);
    Route::post('/incidencias', [IncidenceController::class, 'createIncident']);
    Route::put('/incidencias/{id}', [IncidenceController::class, 'updateIncident']);
    Route::delete('/incidencias/{id}', [IncidenceController::class, 'deleteIncident']);
    Route::get('/incidencias/search', [IncidenceController::class, 'searchIncidents']); // Search endpoint for Incidencias

    // UsuariResol Routes
    Route::get('/usuari_resols', [ApiController::class, 'indexUsuariResol']);
    Route::post('/usuari_resols', [ApiController::class, 'storeUsuariResol']);
    Route::get('/usuari_resols/{id}', [ApiController::class, 'showUsuariResol']);
    Route::put('/usuari_resols/{id}', [ApiController::class, 'updateUsuariResol']);
    Route::delete('/usuari_resols/{id}', [ApiController::class, 'destroyUsuariResol']);
    Route::get('/usuari_resols/search', [ApiController::class, 'searchUsuariResol']); // Search endpoint for UsuariResol

    // Usuari Routes
    Route::get('/users/search', [ApiController::class, 'searchUsers']); // Search endpoint for Users

    // Zona Routes
    Route::get('/zones/search', [ApiController::class, 'searchZones']); // Search endpoint for Zones
});

// Middleware for checking token permissions
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/incidencias', function (Request $request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });
    
    Route::post('/incidencias', function (Request $request, $next) {
        if ($request->user()->tokenCan('create')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::put('/incidencias/{id}', function (Request $request, $next) {
        if ($request->user()->tokenCan('update')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::delete('/incidencias/{id}', function (Request $request, $next) {
        if ($request->user()->tokenCan('delete')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::get('/incidencias/search', function (Request $request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // UsuariResol Routes
    Route::get('/usuari_resols', function (Request $request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::post('/usuari_resols', function (Request $request, $next) {
        if ($request->user()->tokenCan('create')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::get('/usuari_resols/{id}', function (Request $request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::put('/usuari_resols/{id}', function (Request $request, $next) {
        if ($request->user()->tokenCan('update')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::delete('/usuari_resols/{id}', function (Request $request, $next) {
        if ($request->user()->tokenCan('delete')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::get('/usuari_resols/search', function (Request $request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // Usuari Routes
    Route::get('/users/search', function (Request $request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // Zona Routes
    Route::get('/zones/search', function (Request $request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });
});
