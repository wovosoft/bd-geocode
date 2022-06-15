<?php

namespace Wovosoft\BdGeocode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Laravel\Scout\Searchable;

class Union extends Model
{
    use HasFactory, Searchable;

    public function toSearchableArray(): array
    {
        return [
            "name" => $this->name,
            "bn_name" => $this->bn_name
        ];
    }

    public function upazila(): BelongsTo
    {
        return $this->belongsTo(Upazila::class);
    }

    /**
     * This should be belongsToThrough, but it is not available in laravel yet.
     * So, doing this in this way.
     */
    public function district(): HasOneThrough
    {
        return $this->hasOneThrough(
            District::class,
            Upazila::class,
            "id",
            "id",
            "upazila_id",
            "district_id"
        );
    }

    public function division(): BelongsTo
    {
        return $this->district?->division();
    }
}
