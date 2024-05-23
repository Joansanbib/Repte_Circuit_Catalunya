<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use App\Models\Zona;
use Illuminate\Support\Facades\Auth;

class IncidenceController extends Controller
{
    /**
     * Display a listing of the incidences
     */

    public function index()
    {
        $incident = Incidencia::all();
        return view('incidencies.index', ['incidencies' => $incident]);
    }

    /**
     * Show the form for creating a new incidence
     */
    public function create()
    {
        $zones = Zona::all();
        return view('incidencies.create', ['zones' => $zones]);
    }

    /**
     * Store a newly created incidence in db
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'Nom' => 'required|max:150',
            'Descripcio' => 'required|max:500',
            'Estat' => 'required',
            'Prioritat' => 'required',
            'Zona' => 'required',
            'Imatge' => 'required|image',
            'Rol_assignat' => 'required',
        ]);
        $incident = new Incidencia($validatedData);
        //$incident->Usuari_denunciant = Auth::id();
        $incident->Data = now();
        $photoName = time() . '_' . $request->Imatge->getClientOriginalName();
        $path = public_path('img/');
        $request->Imatge->move($path, $photoName);
        $incident->Ruta_img = $photoName;

        // if ($request->hasFile('image')) {
        //     $incident->image = $request->file('image')->store('public/incidences');
        // }
        $incident->save();

        return redirect()->Route('incidences.index')->with('success', 'Incidence created successfully');

    }

    /**
     * Display the specified incidence
     */

    public function show(Incidencia $incidence)
    {

        $incident = Incidencia::all();
        return view('incidencies.index', ['incidencies' => $incident]);
    }


    /**
     * Show the form for editing specified incidence 
     */


    public function edit(Incidencia $incidence)
    {
        $user = Auth::user();
        $this->authorize('access', $user);
        
        $zones = Zona::all();
        return view('incidencies.edit', ['incidencia' => $incidence], ['zones' => $zones]);
    }


    /**
     * Update the specified incidence in storage
     */


    public function update(Request $request, Incidencia $incidence)
    {
        $user = Auth::user();
        $this->authorize('access', $user);

        $validatedData = $request->validate([
            'Nom' => 'required|max:150',
            'Descripcio' => 'required|max:500',
            'Estat' => 'required',
            'Prioritat' => 'required',
            'Zona' => 'required',
            'Rol_assignat' => 'required',
        ]);
        if(!is_null($request->Imatge)){
            $photoName = time() . '_' . $request->Imatge->getClientOriginalName();
            $path = public_path('img/');
            $request->Imatge->move($path, $photoName);
            $incidence->Ruta_img = $photoName;
        }
        $incidence->update($validatedData);

        return redirect()->route('incidences.index')->with('success', 'Incidence updated successfully.');
    }


    /**
     * Remove the specified incidence in db
     */


    public function destroy(Incidencia $incidence)
    {
        $user = Auth::user();
        $this->authorize('access', $user);

        $incidence->delete();

        return redirect()->route('incidences.index')->with('success', 'Incidence deleted successfully.');
    }

}
