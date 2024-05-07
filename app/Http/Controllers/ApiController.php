<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use Illuminate\Http\Request;
use App\Models\Usuari;
// use App\Models\Incident;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('api_key_check'); 
    }

    public function getAllIncidents()
    {
        $this->authorize('isAdmin', Usuari::class);

        $incidents = Incidencia::all();
        return response()->json($incidents);
    }

    public function getUserIncidents()
    {
        $incidents = Incidencia::where('user_id', Auth::id())->get();
        return response()->json($incidents);
    }

    public function createIncident(Request $request)
    {
        $incident = new Incidencia($request->all());
        $incident->user_id = Auth::id();
        $incident->save();

        return response()->json($incident, 201);
    }

    public function updateIncident(Request $request, $id)
    {
        $incident = Incidencia::find($id);

        $this->authorize('isOwnerOrAdmin', $incident);

        $incident->update($request->all());
        return response()->json($incident);
    }

    public function deleteIncident($id)
    {
        $this->authorize('isAdmin', Usuari::class);

        Incidencia::destroy($id);
        return response()->json(null, 204);
    }
}

?>
