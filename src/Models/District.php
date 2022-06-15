<?php

namespace Wovosoft\BdGeocode\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class District extends Model
{
    use HasFactory, Searchable;

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

    public function unions()
    {
        return $this->hasManyThrough(
            Union::class,
            Upazila::class
        );
    }
}
