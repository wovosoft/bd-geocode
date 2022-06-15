<?php

namespace Wovosoft\BdGeocode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Laravel\Scout\Searchable;

class Upazila extends Model
{
    use HasFactory, Searchable;

    public function toSearchableArray(): array
    {
        return [
            "name" => $this->name,
            "bn_name" => $this->bn_name
        ];
    }

    /**
     * This should be belongsToThrough, but it is not available in laravel yet.
     * So, doing this in this way.
     */
    public function division(): HasOneThrough
    {
        return $this->hasOneThrough(
            Division::class,
            District::class,
            "id",
            "id",
            "district_id",
            "division_id"
        );
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function unions(): HasMany
    {
        return $this->hasMany(Union::class);
    }

}
