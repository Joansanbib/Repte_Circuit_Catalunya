<?php

namespace App\Http\Controllers;

use App\Models\Incidencia;
use App\Models\UsuariResol;
use App\Models\Usuari;
use App\Models\Zona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->middleware('api_key_check');
    }

    // Incidencias Endpoints
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

    public function searchIncidents(Request $request)
    {
        $query = Incidencia::query();

        if ($request->filled('description')) {
            $query->where('Descripcio', 'like', '%' . $request->description . '%');
        }

        if ($request->filled('zone')) {
            $query->where('Zona', $request->zone);
        }

        if ($request->filled('state')) {
            $query->where('Estat', $request->state);
        }

        if ($request->filled('priority')) {
            $query->where('Prioritat', $request->priority);
        }

        return response()->json($query->get());
    }

    // UsuariResols Endpoints
    public function indexUsuariResol()
    {
        $resolutions = UsuariResol::where('Usuari', Auth::id())->get();
        return response()->json($resolutions);
    }

    public function storeUsuariResol(Request $request)
    {
        $request->validate([
            'Incidencia' => 'required|exists:incidencias,id',
            'Comentaris' => 'required|string',
            'Estat' => 'required|in:Solucionada,En manteniment',
            'Inici' => 'required|date',
            'Final' => 'required|date|after_or_equal:Inici',
        ]);

        $resolution = new UsuariResol($request->all());
        $resolution->Usuari = Auth::id();
        $resolution->save();

        return response()->json($resolution, 201);
    }

    public function showUsuariResol($id)
    {
        $resolution = UsuariResol::where('id', $id)->firstOrFail();
        return response()->json($resolution);
    }

    public function updateUsuariResol(Request $request, $id)
    {
        $resolution = UsuariResol::find($id);

        $request->validate([
            'Comentaris' => 'sometimes|string',
            'Estat' => 'sometimes|in:Solucionada,En manteniment',
            'Inici' => 'sometimes|date',
            'Final' => 'sometimes|date|after_or_equal:Inici',
        ]);

        $resolution->update($request->all());
        return response()->json($resolution);
    }

    public function destroyUsuariResol($id)
    {
        UsuariResol::destroy($id);
        return response()->json(null, 204);
    }

    public function searchUsuariResol(Request $request)
    {
        $query = UsuariResol::query();

        if ($request->filled('state')) {
            $query->where('Estat', $request->state);
        }

        if ($request->filled('incidencia_id')) {
            $query->where('Incidencia', $request->incidencia_id);
        }

        if ($request->filled('comments')) {
            $query->where('Comentaris', 'like', '%' . $request->comments . '%');
        }

        if ($request->filled('start_time')) {
            $query->where('Inici', $request->start_time);
        }

        if ($request->filled('end_time')) {
            $query->where('Final', $request->end_time);
        }

        return response()->json($query->get());
    }

    // Usuaris Endpoints
    public function searchUsers(Request $request)
    {
        $query = Usuari::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('surname')) {
            $query->whereRaw("CONCAT(first_name, ' ', second_name) LIKE ?", ["%{$request->surname}%"]);
        }

        if ($request->filled('nif')) {
            $query->where('NIF', $request->nif);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('role')) {
            $query->where('Rol', $request->role);
        }

        return response()->json($query->get());
    }

    // Zones Endpoints
    public function searchZones(Request $request)
    {
        $query = Zona::query();

        if ($request->filled('id')) {
            $query->where('id', $request->id);
        }

        if ($request->filled('description')) {
            $query->where('Descripcio', 'like', '%' . $request->description . '%');
        }

        if ($request->filled('incidencia_id')) {
            $query->whereHas('incidencias', function ($q) use ($request) {
                $q->where('id', $request->incidencia_id);
            });
        }

        if ($request->filled('name')) {
            $query->where('Nom', 'like', '%' . $request->name . '%');
        }

        return response()->json($query->get());
    }
}
