<?php

namespace App\Enum;

enum MetadataEnumSign: string
{
    case TOTO = 'toto';
    case TATA = 'tata';
    case TITI = 'titi';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

}
