<?php

namespace App\Policies;

use App\Models\Usuari;
use Illuminate\Auth\Access\Response;

class checkRole
{
    public function access(Usuari $user)
    {
        return $user->Rol !== 'Operari';
    }
}
