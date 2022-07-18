<?php

namespace Wovosoft\BdGeocode\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Wovosoft\BdGeocode\Models\Division;
use Wovosoft\LaravelCommon\Helpers\Data;

trait HasDivisionActions
{
    /**
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        return Data::store(Division::query(), $request);
    }

    /**
     * @throws \Throwable
     */
    public function update(Request $request, Division $division): JsonResponse
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

    public function districts(Request $request, Division $division)
    {
        return $division;
//        return Data::options($division->districts(), $request);
    }

    public function upazilas(Division $division, Request $request): Collection
    {
        return Data::options($division->upazilas(), $request);
    }

    public function unions(Division $division, Request $request): Collection
    {
        return Data::options($division->unions(), $request);
    }
}
