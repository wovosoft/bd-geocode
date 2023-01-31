<?php

use Wovosoft\BdGeocode\Http\Controllers\{
    DistrictController,
    DivisionController,
    UnionController,
    UpazilaController
};


return [
    "database" => [
        "connection" => config("database.default"),
        "migrations" => true
    ],
    "views" => true,
    "routes" => [
        "enabled" => false,
        "prefix" => "geocode",
    ],
    "table" => [
        "prefix" => "geocode_"
    ],

    /**
     * These four config values are directly passed to default routes registration method, when
     * routes_enabled = true
     */
    "division_controller" => DivisionController::class,
    "district_controller" => DistrictController::class,
    "upazila_controller" => UpazilaController::class,
    "union_controller" => UnionController::class
];
