<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

final class Personas extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'documento', 
        'direccion', 
        'telefono',
        'email'
    ];

    protected $casts = [
        'discapacitado' => 'boolean',
        'fecha_nacimiento' => 'datetime',
    ];
    
    public function hijos(): HasMany
    {
        return $this->hasMany(Hijo::class, 'persona_id');
    }

}
