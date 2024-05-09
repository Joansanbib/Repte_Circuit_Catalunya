<?php

namespace App\Policies;

use App\Models\Incidencia;
use App\Models\Usuari;

class IncidentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function delete(Usuari $user, Incidencia $incident)
{
    return $user->Rol === 'admin';
}

public function update(Usuari $user, Incidencia $incident)
{
    return $user->id === $incident->user_id || $user->Rol === 'admin';
}

}
