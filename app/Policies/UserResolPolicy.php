<?php

namespace App\Policies;

use App\Models\Usuari;
use App\Models\UsuariResol;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsuariResolPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Usuari can view any Usuari resolutions.
     */
    public function viewAny(Usuari $Usuari)
    {
        // Only admins can view all resolutions
        return $Usuari->Rol === 'admin';
    }

    /**
     * Determine whether the Usuari can view the Usuari resolution.
     */
    public function view(Usuari $Usuari, UsuariResol $UsuariResol)
    {
        // Usuaris can view a resolution if they are an admin or involved in the resolution
        return $Usuari->Rol === 'admin' || $Usuari->id === $UsuariResol->Usuari_id;
    }

    /**
     * Determine whether the Usuari can create Usuari resolutions.
     */
    public function create(Usuari $Usuari)
    {
        // All authenticated Usuaris can create a resolution
        return true;
    }

    /**
     * Determine whether the Usuari can update the Usuari resolution.
     */
    public function update(Usuari $Usuari, UsuariResol $UsuariResol)
    {
        // Usuaris can update a resolution if they are an admin or own the resolution
        return $Usuari->Rol === 'admin' || $Usuari->id === $UsuariResol->Usuari_id;
    }

    /**
     * Determine whether the Usuari can delete the Usuari resolution.
     */
    public function delete(Usuari $Usuari, UsuariResol $UsuariResol)
    {
        // Only admins can delete a resolution
        return $Usuari->Rol === 'admin';
    }
}
