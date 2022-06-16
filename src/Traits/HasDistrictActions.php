<?php

namespace Wovosoft\BdGeocode\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Wovosoft\BdGeocode\Assets\Data;
use Wovosoft\BdGeocode\Models\District;
use Wovosoft\BdGeocode\Models\Division;

trait HasDistrictActions
{
    private function validate(Request $request): array
    {
        return $request->validate([
            "name" => ["string", "required"],
            "bn_name" => ["string", "nullable"],
            "lat" => ["string", "nullable"],
            "lon" => ["string", "nullable"],
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
            $item = new District();
            $item->forceFill($this->validate($request))->saveOrFail();
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
    public function update(District $district, Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $district->forceFill($this->validate($request))->saveOrFail();
            DB::commit();
            return response()->json([
                "id" => $district->id,
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
        return Data::totOptions(District::query()->select($request->input("cols") ?? ["id", "name", "bn_name", "url"]), $request);
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return District::query()
            ->when($request->input("filter"), function (Builder $builder, string $filter) {
                $builder->search($filter);
            })
            ->select($request->input("cols") ?? ["*"])
            ->paginate(
                perPage: $request->input("per_page") ?? 15,
                page: $request->input("current_page") ?? 1
            );
    }

    /**
     * @throws \Throwable
     */
    public function destroy(District $district): JsonResponse
    {
        DB::beginTransaction();
        try {
            $district->deleteOrFail();
            DB::commit();
            return response()->json([
                "id" => $district?->id,
                "message" => "Successfully Done"
            ]);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                "message" => $exception->getMessage()
            ], 403);
        }
    }

    public function division(District $district): ?Division
    {
        return $district->division;
    }

    public function upazilas(District $district, Request $request): Collection
    {
        return Data::totOptions($district->upazilas(), $request);
    }

    public function unions(District $district, Request $request): Collection
    {
        return Data::totOptions($district->unions(), $request);
    }
}
