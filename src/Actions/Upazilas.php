<?php

namespace Wovosoft\BdGeocode\Actions;

use Wovosoft\BdGeocode\Traits\HasUpazilaActions;

class Upazilas
{
    use HasUpazilaActions;

    public static function new(): static
    {
        return new static();
    }
}
