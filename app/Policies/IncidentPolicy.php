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

    public function viewAny(Usaria $user)
    {
        return true;
    }


    public function view(Usaria $user, Incidencia $incident)
    {
        return $user->Rol ==='admin' || $user->id === $incident->user_id;
    }

    public function create(Usaria $user)
    {
        return true; //only auth user can create incidences
    }

    public function update(Usaria $user, Incidencia $incident)
    {
        return $user->Rol === 'admin' || $user->id ===$incident->user_id;
    }

    public function delete(Usaria $user, Incidencia $incident)
    {
        return $user->Rol === 'admin'; //only admin can delete incidences 
    }

}
