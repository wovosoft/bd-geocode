<?php

namespace Wovosoft\BdGeocode\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wovosoft\BdGeocode\Traits\HasDivisionActions;

class DivisionController extends Controller
{
    use HasDivisionActions;
}
