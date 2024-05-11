<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usaria;
use Illuminate\Support\Facades\Auth;

class UserResolController extends Controller
{
    /**
     * Display a listing of the user reso
     */


    public function index()
    {
        $resolutions = UsariaResol::with(['incidencia', 'usuari'])
        ->where('usuari', Auth::id())
        ->get();

        return view('usuari_resols.index', compact('resolutions'));
    }

     /**
      * Show the form for creating a new user reso
      *
      * @return \Illuminate\Http\Response
      */


      public function create()
      {
        
        $incidence = Incidencia::all();
        $user = Usuari::all();

        return view('user_resols.create', compact('incidences', 'users'));
      }


      /**
       *    Store a newly Created user reso in db 
       * 
       * @param \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */


      public function store(Request $request)
      {
        $request->validate([
            'Incidencia' => 'required|exists:incidencias,id',
            'Usuari' => 'required|exists:usuaris,id',
            'Inici' => 'required|date',
            'Final' => 'required|date|after_or_equal:Inici',
            'Comentaris' => 'required|string|max:500',
            'Estat' => 'required|in:Solucionada,En manteniment',
        ]);

        UsuariResol::create([
            'Incidencia' => $request->Incidencia,
            'Usuari' => $request->Usuari,
            'Inici' => $request->Inici,
            'Final' => $request->Final,
            'Comentaris' => $request->Comentaris,
            'Estat' => $request->Estat,
        ]);

        return redirect()->route('usuari_resols.index')->with('success', 'Resolution created successfully.');
      }

       /**
        * Display the specified user reso
        */


        public function show(UsariaResol $usuariResol)
        {
            return view('usuari_resols.show', compact('usuari_resols', 'incidencias', 'usuaris'));
        }

        /**
         * Show the form for editing the specified user reso
         */

        public function edit(UsariaResol $usuariResol)
        {
            $incidence = Incidencia::all();
            $user = Usuari::all();

            return view('usuari_resols.edit', compact('usuari_resols', 'incidencias', 'usuaris'));
        }


         /**
          * Update the specified user reso
          */

        public function update(Request $request, UsuariResol $usuariResol)
        {
            $request->validate([
                'Incidencia' => 'required|exists:incidencias,id',
                'Usuari' => 'required|exists:usuaris,id',
                'Inici' => 'required|date',
                'Final' => 'required|date|after_or_equal:Inici',
                'Comentaris' => 'required|string|max:500',
                'Estat' => 'required|in:Solucionada,En manteniment',
            ]);
    
            $usuariResol->update([
                'Incidencia' => $request->Incidencia,
                'Usuari' => $request->Usuari,
                'Inici' => $request->Inici,
                'Final' => $request->Final,
                'Comentaris' => $request->Comentaris,
                'Estat' => $request->Estat,
            ]);

            return redirect()->route('usuari_resols.index')->with('success', 'Resolution updated successfully');
        }


          /**
           * Remove the specified user reso from db
           */


        public function destroy(UsariaResol $usuariResol)
        {
            $usuariResol->delete();

            return redirect()->route('usuari_resols.index')->with('success', 'Resolution deleted successfully');
        }
}
