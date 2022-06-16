<?php

use Wovosoft\BdGeocode\Http\Controllers\{DistrictController, DivisionController, UnionController, UpazilaController};


return [
    "routes_enabled" => true,

    /**
     * These four config values are directly passed to default routes registration method, when
     * routes_enabled = true
     */
    "division_controller" => DivisionController::class,
    "district_controller" => DistrictController::class,
    "upazila_controller" => UpazilaController::class,
    "union_controller" => UnionController::class
];
