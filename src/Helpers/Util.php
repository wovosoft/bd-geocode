<?php

namespace Wovosoft\BdGeocode\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;

class Util
{
    public static function rawLower(string $column): Expression
    {
        return DB::raw("lower($column)");
    }

    /**
     * @param string $column
     * @param string $filter
     * @return array
     */
    public static function search(string $column, string $filter): array
    {
        return [
            "column" => static::rawLower($column),
            "operator" => "like",
            "value" => "%" . strtolower($filter) . "%"
        ];
    }

    public static function colSearch(Builder &$builder, string $filter, array $where = [], array $orWhere = []): Builder
    {
        foreach ($where as $col) {
            $builder->where(...static::search($col, $filter));
        }
        foreach ($orWhere as $col) {
            $builder->orWhere(...static::search($col, $filter));
        }
        return $builder;
    }
}
