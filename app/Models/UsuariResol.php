<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuariResol extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuari_resols';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Incidencia',
        'Usuari',
        'Inici',
        'Final',
        'Comentaris',
        'Estat',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'Inici' => 'datetime',
        'Final' => 'datetime',
    ];

    /**
     * Get the incidencia that the resolution belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function incidencia()
    {
        return $this->belongsTo(Incidencia::class, 'Incidencia');
    }

    /**
     * Get the usuari that the resolution belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuari()
    {
        return $this->belongsTo(Usuari::class, 'Usuari');
    }

    /**
     * Scope a query to only include resolutions that are 'Solucionada'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSolucionada($query)
    {
        return $query->where('Estat', 'Solucionada');
    }

    /**
     * Scope a query to only include resolutions that are 'En manteniment'.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeEnManteniment($query)
    {
        return $query->where('Estat', 'En manteniment');
    }
}