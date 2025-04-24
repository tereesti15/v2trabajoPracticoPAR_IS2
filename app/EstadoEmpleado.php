<?php

namespace App;

enum EstadoEmpleado: string
{
    case Activo = 'Activo';
    case Inactivo = 'Inactivo';
    case Permiso = 'Con permiso';
    case Vacaciones = 'De vacaciones';  
}
