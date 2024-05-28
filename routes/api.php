<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Models\Incidencia;
use App\Models\Usuari;
use App\Models\UsuariResol;
use App\Models\Zona;

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

// Middleware for checking token permissions
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/incidencias', function (Request $request) {
        if ($request->user()->tokenCan('read')) {
            $apiController = new ApiController();
            return($apiController->getAllIncidents());
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });
    Route::get('/zones', function (Request $request) {
        if ($request->user()->tokenCan('read')) {
            $apiController = new ApiController();
            return($apiController->getAllZones());
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::post('/incidencias', function(Request $request){
        if ($request->user()->tokenCan('create')) {
            $apiController = new ApiController();
            return $apiController->createIncident($request);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });
    Route::post('/login', function(Request $request){
        $apiController = new ApiController();
        return $apiController->login($request);
    });
    Route::post('/register', function(Request $request){
        $apiController = new ApiController();
        return $apiController->register($request);
    });












    Route::put('/incidencias/{id}', function(Request $request, $id){
        if ($request->user()->tokenCan('update')) {
            $ApiController = new ApiController();
            $ApiController->updateIncident($request, $id);
        }
    });

    Route::delete('/incidencias/{id}', function (Request $request, $id) {
        if ($request->user()->tokenCan('delete')) {
            $incidence = new ApiController();
            $incidence->deleteIncident($id);
        }
    });

    Route::get('/incidencias/search', function (Request $request, $string) {
        if ($request->user()->tokenCan('read')) {
            $incidences = Incidencia::where('Descripcio', 'LIKE', "%{$string}%")->get();
            return response()->json($incidences);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // UsuariResol Routes
    Route::get('/usuari_resols', function (Request $request) {
        if ($request->user()->tokenCan('read')) {
            return response()->json(UsuariResol::all());
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::post('/usuari_resols', function (Request $request) {
        if ($request->user()->tokenCan('create')) {
            $usuariResol = UsuariResol::create($request->all());
            return response()->json(['message' => 'UsuariResol created successfully']);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::get('/usuari_resols/{id}', function (Request $request, $id) {
        if ($request->user()->tokenCan('read')) {
            return response()->json(UsuariResol::findOrFail($id));
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::post('/usuari_resols/{id}', function (Request $request, $id) {
        if ($request->user()->tokenCan('update')) {
            $usuariResol = UsuariResol::findOrFail($id);
            $usuariResol->update($request->all());
            return response()->json(['message' => 'UsuariResol updated successfully']);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::delete('/usuari_resols/{id}', function (Request $request, $id) {
        if ($request->user()->tokenCan('delete')) {
            $usuariResol = UsuariResol::findOrFail($id);
            $usuariResol->delete();
            return response()->json(['message' => 'UsuariResol deleted successfully']);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    Route::get('/usuari_resols/search', function (Request $request, $string) {
        if ($request->user()->tokenCan('read')) {
            $resolutions = UsuariResol::where('Comentaris', 'LIKE', "%{$string}%")->get();
            return response()->json($resolutions);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // Usuari Routes
    Route::get('/users/search', function (Request $request, $string) {
        if ($request->user()->tokenCan('read')) {
            $users = Usuari::where('name', 'LIKE', "%{$string}%")->get();
            return response()->json($users);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });

    // Zona Routes
    Route::get('/zones/search', function (Request $request, $string) {
        if ($request->user()->tokenCan('read')) {
            $zones = Zona::where('Nom', 'LIKE', "%{$string}%")->get();
            return response()->json($zones);
        } else {
            return response()->json(['message' => 'El token no tiene permisos'], 403);
        }
    });
});