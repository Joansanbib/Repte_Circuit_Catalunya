<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incidencia;
use Illuminate\Support\Facades\Auth;

class IncidenceController extends Controller
{
    /**
     * Display a listing of the incidences
     */

    public function index()
    {
        $this->authorize('viewAny', Incidencia::class);

        $incident = Incidencia::where('user_id', Auth::id())->get();
        return view('incidences.index', ['incidebes' => $incident]);
    }

    /**
     * Show the form for creating a new incidence
     */
    public function create()
    {
        $this->authorize('create', Incidencia::class);

        return view('incidences.create');
    }

    /**
     * Store a newly created incidence in db
     */
    public function store(Request $request)
    {
        $this->authorize('create', Incidencia::class);
        $validatedData = $request->validate([
            'Descripcio' => 'required|max:255',
            'Estat' => 'required',
            'Prioritat' => 'required',
            'Zona' => 'required',
            'Ruta_img' => 'sometimes|image|max:5000',
        ]);
        $incident = new Incidencia($validatedData);
        $incident->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $incident->image = $request->file('image')->store('public/incidences');
        }

        $incident->save();

        return redirect()->Route('incidences.index')->with('success', 'Incidence created successfully');

    }

    /**
     * Display the specified incidence
     */

    public function show(Incidencia $incidence)
    {
        $this->authorize('view', $incidence);

        return view('incidences.show', ['incidence' => $incidence]);
    }


    /**
     * Show the form for editing specified incidence 
     */


    public function edit(Incidencia $incidence)
    {
        $this->authorize('update', $incidence);

        return view('incidences.edit', ['incidence' => $incidence]);
    }


    /**
     * Update the specified incidence in storage
     */


    public function update(Request $request, Incidencia $incidence)
    {
        $this->authorize('update', $incidence);

        $validatedData = $request->validate([
            'Descripcio' => 'required|max:255',
            'Estat' => 'required',
            'Prioritat' => 'required',
            'Zona' => 'required',
            'Ruta_img' => 'sometimes|image|max:5000',
        ]);

        if ($request->hasFile('Ruta_img')) {
            $incidence->image = $request->file('Ruta_img')->store('public/incidences');
        }

        $incidence->update($validatedData);

        return redirect()->route('incidences.index')->with('success', 'Incidence updated successfully.');
    }


    /**
     * Remove the specified incidence in db
     */


    public function destroy(Incidencia $incidence)
    {
        $this->authorize('delete', $incidence);

        $incidence->delete();

        return redirect()->route('incidences.index')->with('success', 'Incidence deleted successfully.');
    }

}
