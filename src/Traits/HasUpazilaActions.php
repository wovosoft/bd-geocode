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

trait HasUpazilaActions
{
    /**
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        return Data::store(new Upazila(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function update(Request $request, Upazila $upazila): JsonResponse
    {
        return Data::store($upazila, $request);
    }

    public function options(Request $request): Collection|array
    {
        return Data::options(Upazila::query(), $request);
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return Data::paginate(Upazila::query(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function destroy(Upazila $upazila): JsonResponse
    {
        return Data::destroy($upazila);
    }

    public function division(Upazila $upazila): ?Division
    {
        return $upazila->division;
    }

    public function district(Upazila $upazila): ?District
    {
        return $upazila->district;
    }

    public function unions(Request $request, Upazila $upazila): Collection
    {
        return $upazila->unions()
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

    public function union(Request $request, Upazila $upazila, Union $union): Union
    {
        return $union;
    }

    public function single(Upazila $upazila): Upazila
    {
        return $upazila;
    }
}
