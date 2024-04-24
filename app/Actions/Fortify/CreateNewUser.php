<?php

namespace App\Actions\Fortify;

use App\Models\Usuari;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Usuari
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Usuari::class],
            'password' => ['required', 'string', 'confirmed', $this->passwordRules()],
            'NIF' => ['required', 'string', 'size:9', 'unique:'.Usuari::class],
        ],[
            'NIF.size' => 'El NIF ha de tenir 9 caràcters.',
            'NIF.unique' => 'Aquest NIF ja està registrat.',

        ])->validate();

        return Usuari::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'NIF' => $input['NIF'],
        ]);
    }
}
