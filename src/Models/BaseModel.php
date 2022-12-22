<?php

namespace Wovosoft\BdGeocode\Models;

use Illuminate\Database\Eloquent\Model;
use Wovosoft\LaravelCommon\Traits\HasTablePrefix;

class BaseModel extends Model
{
    use HasTablePrefix;

    public function getPrefix(): string
    {
        return config("bd-geocode.table.prefix");
    }
}
