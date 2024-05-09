<?php

namespace App\Policies;

use App\Models\Usuari;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(Usuari $Usuari)
    {
        // Only admins can view the user list
        return $Usuari->role === 'admin';
    }

    /**
     * Determine whether the user can view the user.
     */
    public function view(Usuari $Usuari, Usuari $model)
    {
        // Users can view a user if they are an admin or they are viewing their own profile
        return $Usuari->role === 'admin' || $Usuari->id === $model->id;
    }

    /**
     * Determine whether the user can create users.
     */
    public function create(Usuari $Usuari)
    {
        // Only admins can create users
        return $Usuari->role === 'admin';
    }

    /**
     * Determine whether the user can update the user.
     */
    public function update(Usuari $Usuari, Usuari $model)
    {
        // Users can update a user if they are an admin or updating their own profile
        return $Usuari->role === 'admin' || $Usuari->id === $model->id;
    }

    /**
     * Determine whether the user can delete the user.
     */
    public function delete(Usuari $Usuari, Usuari $model)
    {
        // Only admins can delete a user
        return $Usuari->role === 'admin';
    }
}
