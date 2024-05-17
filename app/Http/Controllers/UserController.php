<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     */


    public function index()
    {
        $this->authorize('viewAny', Usaria::class);

        $user = Usaria::all();
        return view("users.index", ["user" => $user]);

    }
    /**
     * Show the form for creating a new user
     */


    public function create()
    {
        $this->authorize('create', Usaria::class);

        return view('users.create');

    }


    /**
     * Store a newly created user in db
     */



    public function store(Request $request)
    {
        $this->authorize('create', Usaria::class);

        $validatedData = $request->validate([
            'NIF' => 'required|max:9',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'Rol' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = Usaria::create($validatedData);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }
    /**
     * Display the specified user
     */

    public function show(Usaria $user)
    {
        $this->authorize('view', $user);

        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form of editing the specified user
     */


    public function edit(Usaria $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', ['user' => $user]);
    }

    /**
     * Update the specified user in db
     */


    public function Update(Request $request, Usaria $user)
    {
        $this->authorize('update', $user);

        $validatedData = $request->validate([
            'NIF' => 'required|max:9',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users' . $user->id,
            'password' => 'required|min:6|confirmed',
            'Rol' => 'required',
        ]);

        if ($validatedData['password']) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


    /**
     * Remove the specified user from db
     */

    public function destroy(Usaria $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }


}
