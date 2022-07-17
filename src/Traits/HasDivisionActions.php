<?php

namespace Wovosoft\BdGeocode\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Wovosoft\BdGeocode\Assets\Data;
use Wovosoft\BdGeocode\Models\Division;

trait HasDivisionActions
{
    public function validated(Request $request)
    {
        return $request->validate([
            "name" => ["string", "required"],
            "bn_name" => ["string", "nullable"],
            "url" => ["string", "nullable"]
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function store(Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $item = new Division();
            $item->forceFill($this->validated($request))->saveOrFail();
            DB::commit();
            return response()->json([
                "id" => $item->id,
                "message" => "Successfully Done"
            ]);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                "message" => $exception->getMessage()
            ], 403);
        }
    }

    /**
     * @throws \Throwable
     */
    public function update(Request $request, $division)
    {
        $division = Division::query()->findOrFail($division);
        DB::beginTransaction();
        try {
            $division
                ->forceFill($this->validated($request))
                ->saveOrFail();
            DB::commit();
            return response()->json([
                "id" => $division->id,
                "message" => "Successfully Done"
            ]);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                "message" => $exception->getMessage()
            ], 403);
        }
    }

    public function options(Request $request): Collection|array
    {
        return Data::totOptions(Division::query()->select($request->input("cols") ?? ["id", "name", "bn_name", "url"]), $request);
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return Division::query()
            ->when($request->input("filter"), function (Builder $builder, string $filter) {
                $builder->search($filter);
            })
            ->paginate(
                perPage: $request->input("per_page") ?? 15,
                page: $request->input("current_page") ?? 1
            );
    }

    /**
     * @throws \Throwable
     */
    public function destroy(Division $division): JsonResponse
    {
        DB::beginTransaction();
        try {
            $division->deleteOrFail();
            DB::commit();
            return response()->json([
                "id" => $division?->id,
                "message" => "Successfully Done"
            ]);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                "message" => $exception->getMessage()
            ], 403);
        }
    }

    public function districts(Division $division, Request $request): Collection
    {
        return Data::totOptions($division->districts(), $request);
    }

    public function upazilas(Division $division, Request $request): Collection
    {
        return Data::totOptions($division->upazilas(), $request);
    }

    public function unions(Division $division, Request $request): Collection
    {
        return Data::totOptions($division->unions(), $request);
    }
}
