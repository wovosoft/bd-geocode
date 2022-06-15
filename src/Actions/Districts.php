<?php

namespace Wovosoft\BdGeocode\Actions;

use Wovosoft\BdGeocode\Traits\HasDistrictActions;

class Districts
{
    use HasDistrictActions;

    public static function new(): static
    {
        return new static();
    }
}
