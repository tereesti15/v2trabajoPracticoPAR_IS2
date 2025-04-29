<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Personas extends Model
{
    protected $fillable = ['nombre', 'apellido', 'documento', 
            'direccion', 'telefono','email'];
    
    public function hijos()
    {
        return $this->hasMany(Hijos::class, 'persona_id');
    }
}
