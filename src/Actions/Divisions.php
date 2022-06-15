<?php

namespace Wovosoft\BdGeocode\Actions;

use Wovosoft\BdGeocode\Traits\HasDivisionActions;

class Divisions
{
    use HasDivisionActions;

    public static function new(): static
    {
        return new static();
    }
}
