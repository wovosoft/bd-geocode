<?php

namespace Wovosoft\BdGeocode\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;
use Wovosoft\LaravelCommon\Helpers\Data;

trait HasUnionActions
{
    /**
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        return Data::store(new Union(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function update(Request $request, Union $union): JsonResponse
    {
        return Data::store($union, $request);
    }

    public function options(Request $request): Collection|array
    {
        return Data::options(Union::query(), $request);
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return Data::paginate(Union::query(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function destroy(Union $union): JsonResponse
    {
        return Data::destroy($union);
    }

    public function division(Union $union): ?Division
    {
        return $union->division;
    }

    public function district(Union $union): ?District
    {
        return $union->district;
    }

    public function upazila(Union $union): ?Upazila
    {
        return $union->upazila;
    }

    public function single(Union $union): Union
    {
        return $union;
    }
}
