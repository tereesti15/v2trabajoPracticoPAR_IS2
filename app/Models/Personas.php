<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class Personas extends Model
{
    protected $fillable = ['nombre', 'apellido', 'documento', 
            'direccion', 'telefono','email'];
    
    //
}
