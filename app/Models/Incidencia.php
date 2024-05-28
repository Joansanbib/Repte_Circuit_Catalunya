<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    protected $table = 'incidencias';

    protected $fillable = [
        'Nom',
        'Descripcio',
        'Data',
        'Estat',
        'Prioritat',
        'Ruta_img',
        'Rol_assignat',
        'Ruta_proforma',
        'Zona',
        'Usuari_denunciant',
    ];

    protected $casts = [
        'Data' => 'date',
    ];

    /**
     * Return the zone that the incidence belongs to
     */

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    /**
     * Get the user that reported the incidence
     */

    public function UsuariDenunciant()
    {
        return $this->belongsTo(Usuari::class, 'Usuari_denunciant');
    }
}
