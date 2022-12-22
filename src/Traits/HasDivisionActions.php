<?php

namespace Wovosoft\BdGeocode\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Wovosoft\BdGeocode\Helpers\Util;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;
use Wovosoft\LaravelCommon\Helpers\Data;

trait HasDivisionActions
{
    /**
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        return Data::store(new Division(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function update(Division $division, Request $request): JsonResponse
    {
        return Data::store($division, $request);
    }

    public function options(Request $request): Collection|array
    {
        return Data::options(Division::query(), $request);
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return Data::paginate(Division::query(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function destroy(Division $division): JsonResponse
    {
        return Data::destroy($division);
    }

    public function districts(Request $request, Division $division): Collection|array
    {
        return $division->districts()
            ->when($request->input("filter"), function (Builder $builder, string $filter) use ($division) {
                $districts = District::getTableName();

                Util::colSearch(
                    builder: $builder,
                    filter: $filter,
                    where: ["$districts.name"],
                    orWhere: ["$districts.bn_name"]
                );
            })
            ->get();
    }

    public function upazilas(Request $request, Division $division): Collection
    {
        return $division->upazilas()
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

    public function unions(Request $request, Division $division): Collection
    {
        return $division->unions()
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

    public function single(Request $request, Division $division): Division
    {
        return $division;
    }

    public function upazila(Request $request, Division $division, Upazila $upazila): Upazila
    {
        return $upazila;
    }

    public function district(Request $request, Division $division, District $district): District
    {
        return $district;
    }

    //due to limitation of multi-depth relations, this method is being implemented in
    //a different customized way.
    public function union(Request $request, Division $division, $union): Model|Builder
    {
        $unions = Union::getTableName();

        return $division->unions()
            ->where("$unions.id", "=", $union)
            ->firstOrFail();
    }
}
