# Configuration

First publish the configuration file

```shell
php artisan vendor:publish --tag="bkb-offices.config"
```

The above command will create a copy of `bkb-offices.php` file in `config` directory.

## Config contents

```php
return [
    "routes_enabled" => true,           //when true, routes will be registered automatically
    "routes_middleware" => ["auth"],    // default list of middlewares for the routes
    "views_enabled" => true             // when true, package views are registered automatically
];
```

## Options `routes_enabled`

When this option is set to `true`, default routes for the basic CRUD operations will be added automatically.
Routes defined bellow will be added

```php
Route::controller(OfficeController::class)
    ->prefix("offices")
    ->name("offices.")
    ->group(function () {
        Route::put("store", "store")->name("store");
        Route::put("update/{office}", "update")->name("update");
        Route::post("/", "index")->name("index");
        Route::delete("/delete/{office}", "delete")->name("delete");
        Route::post("/options", "options")->name("options");
    });

Route::controller(OfficeTypeController::class)
    ->prefix("office_types")
    ->name("office_types.")
    ->group(function () {
        Route::put("store", "store")->name("store");
        Route::put("update/{office}", "update")->name("update");
        Route::post("/", "index")->name("index");
        Route::delete("/delete/{office}", "delete")->name("delete");
        Route::post("/options", "options")->name("options");
        Route::post("/type/{office_type}/offices", "offices")->name("offices");
    });
```

These routes are wrapped by the default middlewares defined in `config('bkb-offices.routes_middleware')`. The routes are
loaded in packages `routes/web.php` file, where the main mechanism is done behind the scene. The package service
provider is responsible for registering routes depending on the value of `config('bkb-offices.routes_enabled')`

## Manual Registration of Routes

First disable the option `routes_enabled` by setting the value to `false`.

Now, inside projects `routes/web.php` or `routes/api.php` or wherever you want, do the following:

```php
use \Illuminate\Support\Facades\Route;
use \Wovosoft\BkbOffices\Controllers\OfficeController;
use \Wovosoft\BkbOffices\Facades\BkbOffices;

Route::controller(OfficeController::class)
    ->middleware(["auth:web","auth:sanctum"])
    ->prefix("bkb-offices")
    ->group(function (){
        BkbOffices::routes();
    });
```

The main point is `BkbOffices::routes()`, after disabling default routes registration wrap this line of code by your
desired route registration conditions.

**UPCOMING: Details for other options**
