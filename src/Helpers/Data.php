<?php

namespace Wovosoft\BdGeocode\Assets;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class Data
{
    public static function totOptions(Builder $builder, Request $request): Collection
    {
        return $builder
            ->when($request->input("filter"), function (Builder $builder, string $filter) {
                $builder->search($filter);
            })
            ->limit($request->input("limit") ?? 25)
            ->get();
    }
}
