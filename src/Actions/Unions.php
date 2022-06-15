<?php

namespace Wovosoft\BdGeocode\Actions;

use Wovosoft\BdGeocode\Traits\HasUnionActions;

class Unions
{
    use HasUnionActions;

    public static function new(): static
    {
        return new static();
    }
}
