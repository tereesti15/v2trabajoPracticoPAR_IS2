<?php

namespace App;

enum EstadoNomina: string
{
    case Modificable = 'Modificable';
    case Confirmado = 'Confirmado';
}
