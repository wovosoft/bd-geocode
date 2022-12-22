<?php

namespace Wovosoft\BdGeocode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class District extends BaseModel
{
    use HasFactory;


    public static function rules(): array
    {
        return [
            "name" => ["string", "required"],
            "bn_name" => ["string", "nullable"],
            "lat" => ["string", "nullable"],
            "lon" => ["string", "nullable"],
            "url" => ["string", "nullable"]
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            "name" => $this->name,
            "bn_name" => $this->bn_name
        ];
    }

    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    public function upazilas(): HasMany
    {
        return $this->hasMany(Upazila::class);
    }

    public function unions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Union::class,
            Upazila::class
        );
    }
}
