<?php

namespace App;

enum TipoConceptoNomina:string
{
    case ACREDITACION = 'acreditacion';
    case DESCUENTO = 'descuento';

    public function label(): string
    {
        return match ($this) {
            self::ACREDITACION => 'Acreditación',
            self::DESCUENTO => 'Descuento',
        };
    }
}
