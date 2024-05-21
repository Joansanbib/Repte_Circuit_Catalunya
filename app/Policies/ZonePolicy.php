<?php

namespace App\Policies;

use App\Models\Usuari;
use App\Models\Zona;
use Illuminate\Auth\Access\HandlesAuthorization;

class ZonePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any zones.
     */
    public function viewAny(Usuari $Usuari)
    {
        // Only admins can view zones
        return $Usuari->Rol === 'admin';
    }

    /**
     * Determine whether the user can view the zone.
     */
    public function view(Usuari $Usuari, Zona $zone)
    {
        // Only admins can view a zone
        return $Usuari->Rol === 'admin';
    }

    /**
     * Determine whether the user can create zones.
     */
    public function create(Usuari $Usuari)
    {
        // Only admins can create a zone
        return $Usuari->Rol === 'admin';
    }

    /**
     * Determine whether the user can update the zone.
     */
    public function update(Usuari $Usuari, Zona $zone)
    {
        // Only admins can update a zone
        return $Usuari->Rol === 'admin';
    }

    /**
     * Determine whether the user can delete the zone.
     */
    public function delete(Usuari $Usuari, Zona $zone)
    {
        // Only admins can delete a zone
        return $Usuari->Rol === 'admin';
    }
}
