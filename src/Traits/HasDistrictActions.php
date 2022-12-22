<?php

namespace Wovosoft\BdGeocode\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Wovosoft\BdGeocode\Helpers\Util;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;
use Wovosoft\LaravelCommon\Helpers\Data;

trait HasDistrictActions
{
    /**
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        return Data::store(new District(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function update(Request $request, District $district,): JsonResponse
    {
        return Data::store($district, $request);
    }

    public function options(Request $request): Collection|array
    {
        return Data::options(District::query(), $request);
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return Data::paginate(District::query(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function destroy(District $district): JsonResponse
    {
        return Data::destroy($district);
    }

    public function upazilas(Request $request, District $district): Collection
    {
        return $district->upazilas()
            ->when($request->input("filter"), function (Builder $builder, string $filter) {
                $upazilas = Upazila::getTableName();

                Util::colSearch(
                    builder: $builder,
                    filter: $filter,
                    where: ["$upazilas.name"],
                    orWhere: ["$upazilas.bn_name"]
                );
            })
            ->get();
    }

    public function unions(Request $request, District $district): Collection
    {
        return $district->unions()
            ->when($request->input("filter"), function (Builder $builder, string $filter) {
                $unions = Union::getTableName();

                Util::colSearch(
                    builder: $builder,
                    filter: $filter,
                    where: ["$unions.name"],
                    orWhere: ["$unions.bn_name"]
                );
            })
            ->get();
    }

    public function single(District $district): District
    {
        return $district;
    }

    public function division(District $district): ?Division
    {
        return $district->division;
    }

    public function upazila(District $district, Upazila $upazila): Upazila
    {
        return $upazila;
    }

    public function union(District $district, Union $union): Union
    {
        return $union;
    }
}
