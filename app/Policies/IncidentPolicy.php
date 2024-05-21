<?php

namespace App\Policies;

use App\Models\Incidencia;
use App\Models\Usuari;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncidentPolicy
{

    use HandlesAuthorization;

    
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(Usuari $user)
    {
        return true;
    }


    public function view(Usuari $user, Incidencia $incident)
    {
        return $user->Rol ==='admin' || $user->id === $incident->user_id;
    }

    public function create(Usuari $user)
    {
        return true; //only auth user can create incidences
    }

    public function update(Usuari $user, Incidencia $incident)
    {
        return $user->Rol === 'admin' || $user->id ===$incident->user_id;
    }

    public function delete(Usuari $user, Incidencia $incident)
    {
        return $user->Rol === 'admin'; //only admin can delete incidences 
    }

}
