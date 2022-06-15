<?php

namespace Wovosoft\BdGeocode\Facades;

use Illuminate\Support\Facades\Facade;

class BdGeocode extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'bd-geocode';
    }
}
