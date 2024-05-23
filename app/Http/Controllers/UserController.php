<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuari;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     */


    public function index()
    {
        $users = Usuari::all();
        return view("usuaris.index", ["users" => $users]);

    }
    /**
     * Show the form for creating a new user
     */


    // public function create()
    // {
    //     $this->authorize('create', Usaria::class);

    //     return view('users.create');

    // }


    /**
     * Store a newly created user in db
     */



    // public function store(Request $request)
    // {

    //     $validatedData = $request->validate([
    //         'NIF' => 'required|max:9',
    //         'name' => 'required|max:255',
    //         'email' => 'required|email|max:255|unique:users',
    //         'password' => 'required|min:6|confirmed',
    //         'Rol' => 'required',
    //     ]);

    //     $validatedData['password'] = Hash::make($validatedData['password']);

    //     $user = Usuari::create($validatedData);

    //     return redirect()->route('users.index')->with('success', 'User created successfully');
    // }
    /**
     * Display the specified user
     */

    public function show(Usuari $user)
    {
        $users = Usuari::all();
        return view("usuaris.index", ["users" => $users]);
    }

    /**
     * Show the form of editing the specified user
     */


    public function edit(Usuari $user)
    {
        $user = Auth::user();
        $this->authorize('access', $user);

        return view('usuaris.edit', ['user' => $user]);
    }

    /**
     * Update the specified user in db
     */


    public function Update(Request $request, Usuari $user)
    {
        $user = Auth::user();
        $this->authorize('access', $user);

        $validatedData = $request->validate([
            'NIF' => 'required|max:9',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:usuaris,email,'.$user->id,
            'password' => 'nullable|min:6',
            'Rol' => 'required',
        ]);

        if (isset($validatedData['password']) && !is_null($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }  else {
            unset($validatedData['password']);
        }       
        $user->update($validatedData);
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified user from db
     */

    public function destroy(Usuari $user)
    {
        $user = Auth::user();
        $this->authorize('access', $user);
        
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }


}
