<?php

namespace Wovosoft\BdGeocode\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Scout\Searchable;


class Division extends Model
{
    use HasFactory, Searchable;

    /**
     * When asks for magic prop 'unions' the builder provider by unions() will be resolved.
     * Otherwise, when unions() is called directly it will provide the builder for further
     * ORM operation on Unions Models directly.
     */
    public function __get($key)
    {
        if ($key === "unions") {
            return $this->unions()->get();
        }
        return parent::__get($key);
    }

    public function toSearchableArray(): array
    {
        return [
            "name" => $this->name,
            "bn_name" => $this->bn_name
        ];
    }

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public function upazilas(): HasManyThrough
    {
        return $this->hasManyThrough(
            Upazila::class,
            District::class
        );
    }

    /**
     * NB: Returns
     * Laravel till v9 doesn't support multi-depth hasManyThrough relationships.
     * So, defining it as attribute.
     * There is a possible better solution: https://github.com/staudenmeir/eloquent-has-many-deep
     * But, it is not yet tested by Me. So, it might take few time to apply it.
     */
    public function unions(): Builder
    {
        return Union::query()
            ->join("upazilas", "upazilas.id", "=", "unions.upazila_id")
            ->join("districts", "districts.id", "=", "upazilas.district_id")
            ->join("divisions", "divisions.id", "=", "districts.division_id")
            ->where("divisions.id", "=", $this->id);
    }

}
