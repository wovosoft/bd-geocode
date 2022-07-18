<?php

namespace Wovosoft\BdGeocode\Http\Controllers;

use App\Http\Controllers\Controller;
use Wovosoft\BdGeocode\Enums\Types;
use Wovosoft\BdGeocode\Facades\BdGeocode;

class GeocodeController extends Controller
{
    public function leavesOf(Types $types, int $id)
    {
        return BdGeocode::leavesOf($types, $id);
    }

    public function rootOf(Types $types, int $id)
    {
        return BdGeocode::rootOf($types, $id);
    }
}
