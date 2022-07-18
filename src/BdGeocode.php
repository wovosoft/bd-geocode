<?php

namespace Wovosoft\BdGeocode;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Wovosoft\BdGeocode\Actions\Districts;
use Wovosoft\BdGeocode\Actions\Divisions;
use Wovosoft\BdGeocode\Actions\Unions;
use Wovosoft\BdGeocode\Enums\Types;
use Wovosoft\BdGeocode\Http\Controllers\DistrictController;
use Wovosoft\BdGeocode\Http\Controllers\GeocodeController;
use Wovosoft\BdGeocode\Http\Controllers\UnionController;
use Wovosoft\BdGeocode\Http\Controllers\UpazilaController;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;

class BdGeocode
{
    /**
     * Returns Division Management Actions
     * @return Divisions
     */
    public function divisions(): Divisions
    {
        return new Divisions();
    }

    /**
     * Returns District Management Actions
     * @return Districts
     */
    public function districts(): Districts
    {
        return new Districts();
    }

    /**
     * Returns Upazila Management Actions
     * @return Upazila
     */
    public function upazilas(): Upazila
    {
        return new Upazila();
    }

    public function unions(): Unions
    {
        return new Unions();
    }

    public function leavesOf(Types $types, int $id): Model|Collection|Builder|array|null
    {
        return match ($types) {
            Types::Division => Division::with(["districts.upazilas.unions"])->findOrFail($id),
            Types::District => District::with(["upazilas.unions"])->findOrFail($id),
            Types::Upazila => Upazila::with(["unions"])->findOrFail($id),
            Types::Union => Union::query()->findOrFail($id),
        };
    }

    public function rootOf(Types $types, int $id): Model|Collection|Builder|array|null
    {
        return match ($types) {
            Types::Division => Division::findOrFail($id),
            Types::District => District::with(["division"])->findOrFail($id),
            Types::Upazila => Upazila::with(["district.division"])->findOrFail($id),
            Types::Union => Union::query()->with(["upazila.district.division"])->findOrFail($id),
        };
    }

    public static function routes(): void
    {
        Route::prefix(config("bd-geocode.routes.prefix"))
            ->name(config("bd-geocode.routes.prefix") . ".")
            ->group(function () {
                Route::post("leaves-of/{types}/{id}", [GeocodeController::class, "leavesOf"])->name("leaves-of");
                Route::post("root-of/{types}/{id}", [GeocodeController::class, "rootOf"])->name("root-of");

                static::divisionRoutes();
                static::districtRoutes();
                static::upazilaRoutes();
                static::unionRoutes();
            });
    }

    public static function divisionRoutes(): void
    {
        Route::prefix("divisions")
            ->name("divisions.")
            ->controller(config("bd-geocode.division_controller"))
            ->group(function () {
                Route::post("/", "index")->name("index");
                Route::put("/store", "store")->name("store");
                Route::post("/options", "options")->name("options");

                Route::prefix("{division}")->group(function () {
                    //single division
                    Route::post("/", "single")->name("single");
                    Route::put("/update", "update")->name("update");
                    Route::delete("/destroy", "destroy")->name("destroy");

                    //districts, upazilas and unions directly under a certain division
                    Route::post("districts", "districts")->name("districts");
                    Route::post("upazilas", "upazilas")->name("upazilas");
                    Route::post("unions", "unions")->name("unions");

                    //scoped districts, upazilas and unions of a division
                    Route::scopeBindings()->group(function () {
                        Route::post("districts/{district}", "district")->name("single-district");
                        Route::post("upazilas/{upazila}", "upazila")->name("single-upazila");
                    });
                    //scoped binding not possible, because proper relation is not made division--->union
                    Route::post("unions/{union}", "union")->name("single-union");
                });
            });
    }

    public static function districtRoutes(): void
    {
        Route::prefix("districts")
            ->name("districts.")
            ->controller(DistrictController::class)
            ->group(function () {
                Route::post("/", "index")->name("index");
                Route::put("/store", "store")->name("store");
                Route::post("/options", "options")->name("options");

                Route::prefix("{district}")->group(function () {
                    Route::post("/", "single")->name("single");
                    Route::put("/update", "update")->name("update");
                    Route::delete("/destroy", "destroy")->name("destroy");

                    Route::post("/upazilas", "upazilas")->name("upazilas");
                    Route::post("/unions", "unions")->name("unions");
                    Route::post("/division", "division")->name("division");

                    //scoped upazilas, unions
                    Route::scopeBindings()->group(function () {
                        Route::post("/upazilas/{upazila}", "upazila")->name("upazila");
                        Route::post("/unions/{union}", "union")->name("union");
                    });
                });
            });
    }

    public static function upazilaRoutes(): void
    {
        Route::prefix("upazilas")
            ->name("upazilas.")
            ->controller(UpazilaController::class)
            ->group(function () {
                Route::post("/", "index")->name("index");
                Route::put("/store", "store")->name("store");
                Route::post("/options", "options")->name("options");

                Route::prefix("{upazila}")
                    ->group(function () {
                        Route::post("/", "single")->name("single");
                        Route::put("/update", "update")->name("update");
                        Route::delete("/destroy", "destroy")->name("destroy");

                        Route::post("/unions", "unions")->name("unions");
                        Route::post("/district", "district")->name("district");
                        Route::post("/division", "division")->name("division");

                        Route::post("/unions/{union}", "union")
                            ->scopeBindings()
                            ->name("union");
                    });
            });
    }

    public static function unionRoutes(): void
    {
        Route::prefix("unions")
            ->name("unions.")
            ->controller(UnionController::class)
            ->group(function () {
                Route::post("/", "index")->name("index");
                Route::put("/store", "store")->name("store");
                Route::post("/options", "options")->name("options");

                Route::prefix("{union}")
                    ->group(function () {
                        Route::post("/", "single")->name("single");
                        Route::put("/update", "update")->name("update");
                        Route::delete("/destroy", "destroy")->name("destroy");

                        Route::post("/upazila", "upazila")->name("upazila");
                        Route::post("/district", "district")->name("district");
                        Route::post("/division", "division")->name("division");
                    });
            });
    }
}
