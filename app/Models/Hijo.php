<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hijo extends Model
{
    protected $fillable = ['persona_id', 'nombre', 'fecha_nacimiento', 'documento']; 
}
