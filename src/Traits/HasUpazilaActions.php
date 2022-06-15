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
use Wovosoft\BdGeocode\Models\Union;
use Wovosoft\BdGeocode\Models\Upazila;

trait HasUpazilaActions
{
    private function validate(Request $request): array
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
            $item = new Upazila();
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
    public function update(Upazila $upazila, Request $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $upazila->forceFill($this->validate($request))->saveOrFail();
            DB::commit();
            return response()->json([
                "id" => $upazila->id,
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
        return Data::totOptions(
            Upazila::query()->select($request->input("cols") ?? ["id", "name", "bn_name", "url"]),
            $request
        );
    }

    public function index(Request $request): LengthAwarePaginator
    {
        return Upazila::query()
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
    public function destroy(Upazila $upazila): JsonResponse
    {
        DB::beginTransaction();
        try {
            $upazila->deleteOrFail();
            DB::commit();
            return response()->json([
                "id" => $upazila?->id,
                "message" => "Successfully Done"
            ]);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                "message" => $exception->getMessage()
            ], 403);
        }
    }

    public function division(Upazila $upazila): ?Division
    {
        return $upazila->division;
    }

    public function district(Upazila $upazila): ?District
    {
        return $upazila->district;
    }

    public function unions(int $upazila, Request $request): Collection
    {
        return Data::totOptions(Union::query()->whereUpazilaId($upazila), $request);
    }
}
