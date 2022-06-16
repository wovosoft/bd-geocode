# Configuration

First publish the configuration file

```shell
php artisan vendor:publish --tag="bd-geocode.config"
```

The above command will create a copy of `bd-geocode.php` file in `config` directory.

## Config contents

```php
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
```

## Routes

To define default routes for CURD operation use the line of code given bellow:

```php
\Wovosoft\BdGeocode\Facades\BdGeocode::routes();
```

You can wrap the routes with other conditions too.

```php
use \Illuminate\Support\Facades\Route;
use \Wovosoft\BdGeocode\Facades\BdGeocode;

Route::middleware(['auth:sanctum'])->group(function (){
    BdGeocode::routes();
});
```

## Customizing default routes controller

```php
use \Illuminate\Support\Facades\Route;
use \Wovosoft\BdGeocode\Facades\BdGeocode;

Route::middleware(['auth:sanctum'])->group(function (){
    BdGeocode::routes(
        divisionController:\App\Http\Controllers\DivisionController::class
    );
});
```

The `BdGeocode::routes` method has four parameters.

- divisionController  : `Wovosoft\BdGeocode\Http\Controllers\DivisionController`
- districtController  : `Wovosoft\BdGeocode\Http\Controllers\DistrictController`
- upazilaController   : `Wovosoft\BdGeocode\Http\Controllers\UpazilaController`
- unionController     : `Wovosoft\BdGeocode\Http\Controllers\UnionController`

left values are parameter name and right values are default values. You are free to change the controllers. If you
set `null` for any controller, then routes with that controller won't be registered.

When `routes_enabled` is `true`, by default following code is executed:

```php
\Wovosoft\BdGeocode\Facades\BdGeocode::routes(
    divisionController: config("bd-geocode.division_controller"),
    districtController: config("bd-geocode.district_controller"),
    upazilaCOntroller: config("bd-geocode.upazila_controller"),
    unionController: config("bd-geocode.union_controller")
);
```

That means you can manage default controllers from here. Also, you can disable actions of some controllers from being
registered by setting value to `null`.
