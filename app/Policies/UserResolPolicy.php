<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UsuariResol;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserResolPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user resolutions.
     */
    public function viewAny(User $user)
    {
        // Only admins can view all resolutions
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view the user resolution.
     */
    public function view(User $user, UsuariResol $userResol)
    {
        // Users can view a resolution if they are an admin or involved in the resolution
        return $user->role === 'admin' || $user->id === $userResol->user_id;
    }

    /**
     * Determine whether the user can create user resolutions.
     */
    public function create(User $user)
    {
        // All authenticated users can create a resolution
        return true;
    }

    /**
     * Determine whether the user can update the user resolution.
     */
    public function update(User $user, UsuariResol $userResol)
    {
        // Users can update a resolution if they are an admin or own the resolution
        return $user->role === 'admin' || $user->id === $userResol->user_id;
    }

    /**
     * Determine whether the user can delete the user resolution.
     */
    public function delete(User $user, UsuariResol $userResol)
    {
        // Only admins can delete a resolution
        return $user->role === 'admin';
    }
}
