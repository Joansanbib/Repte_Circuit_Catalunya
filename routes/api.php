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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "api" middleware group. Now create something great!
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
    Route::get('/incidencias', [IncidenceController::class, 'getAllIncidents'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::post('/incidencias', [IncidenceController::class, 'createIncident'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('create')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::put('/incidencias/{id}', [IncidenceController::class, 'updateIncident'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('update')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::delete('/incidencias/{id}', [IncidenceController::class, 'deleteIncident'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('delete')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::get('/incidencias/search', [IncidenceController::class, 'searchIncidents'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // UsuariResol Routes
    Route::get('/usuari_resols', [ApiController::class, 'indexUsuariResol'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::post('/usuari_resols', [ApiController::class, 'storeUsuariResol'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('create')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::get('/usuari_resols/{id}', [ApiController::class, 'showUsuariResol'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::put('/usuari_resols/{id}', [ApiController::class, 'updateUsuariResol'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('update')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::delete('/usuari_resols/{id}', [ApiController::class, 'destroyUsuariResol'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('delete')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::get('/usuari_resols/search', [ApiController::class, 'searchUsuariResol'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // Usuari Routes
    Route::get('/users/search', [ApiController::class, 'searchUsers'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // Zona Routes
    Route::get('/zones/search', [ApiController::class, 'searchZones'])->middleware(function ($request, $next) {
        if ($request->user()->tokenCan('read')) {
            return $next($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });
});
