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
use Wovosoft\BdGeocode\Http\Controllers\DivisionController;
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

    public function treeOf(Types $type, int $id): Model|Collection|Builder|array|null
    {
        return match ($type) {
            Types::Division => Division::with(["district.upazilas.unions"])->findOrFail($id),
            Types::District => District::with(["upazilas.unions"])->findOrFail($id),
            Types::Upazila => Upazila::with(["unions"])->findOrFail($id),
            Types::Union => Union::query()->findOrFail($id),
        };
    }

    public static function routes(): void
    {
        Route::prefix("/geocode")->name("geocode.")->group(function () {
            //name : geocode.divisions.{index,store,update,destroy,options,districts,upazilas,unions}

            Route::controller(DivisionController::class)
                ->prefix("divisions")
                ->name("divisions.")
                ->group(function () {
                    Route::post("/", "index")->name("index");
                    Route::put("/store", "store")->name("store");
                    Route::put("/update/{division}", "update")->name("update");
                    Route::delete("/destroy/{division}", "destroy")->name("destroy");
                    Route::post("/options", "options")->name("options");
                    Route::post("/{division}/districts", "districts")->name("districts");
                    Route::post("/{division}/upazilas", "upazilas")->name("upazilas");
                    Route::post("/{division}/unions", "unions")->name("unions");

                });

            //name : geocode.districts.{index,store,update,destroy,options,upazilas,unions,division}
            Route::controller(DistrictController::class)
                ->prefix("districts")
                ->name("districts.")
                ->group(function () {
                    Route::post("/", "index")->name("index");
                    Route::put("/store", "store")->name("store");
                    Route::put("/update/{district}", "update")->name("update");
                    Route::delete("/destroy/{district}", "destroy")->name("destroy");
                    Route::post("/options", "options")->name("options");


                    Route::post("/{district}/upazilas", "upazilas")->name("upazilas");
                    Route::post("/{district}/unions", "unions")->name("unions");
                    Route::post("/{district}/division", "division")->name("division");

                });

            //name : geocode.upazilas.{index,store,update,destroy,options,division,district,unions}
            Route::controller(UpazilaController::class)
                ->prefix("upazilas")
                ->name("upazilas.")
                ->group(function () {
                    Route::post("/", "index")->name("index");
                    Route::put("/store", "store")->name("store");
                    Route::put("/update/{upazila}", "update")->name("update");
                    Route::delete("/destroy/{upazila}", "destroy")->name("destroy");
                    Route::post("/options", "options")->name("options");


                    Route::post("/{upazila}/division", "division")->name("division");
                    Route::post("/{upazila}/district", "district")->name("district");
                    Route::post("/{upazila}/unions", "unions")->name("unions");

                });

            //name : geocode.unions.{index,store,update,destroy,options,unions,district,division}
            Route::controller(UnionController::class)
                ->prefix("unions")
                ->name("unions.")
                ->group(function () {
                    Route::post("/", "index")->name("index");
                    Route::put("/store", "store")->name("store");
                    Route::put("/update/{union}", "update")->name("update");
                    Route::delete("/destroy/{union}", "destroy")->name("destroy");
                    Route::post("/options", "options")->name("options");


                    Route::post("/{union}/division", "division")->name("division");
                    Route::post("/{union}/district", "district")->name("district");
                    Route::post("/{union}/upazila", "upazila")->name("upazila");
                });
        });
    }
}
