<?php
if (config("bd-geocode.routes_enabled")) {
    \Wovosoft\BdGeocode\Facades\BdGeocode::routes(
        divisionController: config("bd-geocode.division_controller"),
        districtController: config("bd-geocode.district_controller"),
        upazilaCOntroller: config("bd-geocode.upazila_controller"),
        unionController: config("bd-geocode.union_controller")
    );
}
