<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{

    use HasFactory;

    protected $table = 'cargos';
    protected $primaryKey = 'id_cargo';

    protected $fillable = [
        'nombre_cargo',
        'descripcion_cargo',
        'salario_base',
    ];

    public function empleados()
    {
        return $this->hasMany(Empleados::class, 'id_cargo', 'id_cargo');
    }
}
