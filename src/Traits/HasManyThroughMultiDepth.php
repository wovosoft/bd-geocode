<?php

namespace Wovosoft\BdGeocode\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasManyThroughMultiDepth
{
    /**
     * @param Builder|Model|string $related
     * @param array $through
     * @return mixed
     */
    public function hasManyThroughMultiDepth($related, array $through)
    {
        $query = $related::query();

        ////; will be developed later
        foreach ($through as $class => $key) {
            $table = (new $class)->getTable();

            $query->join($table, $table . "." . $key[0], "=",);
        }
        return $related::query();
    }
//return $this->hasManyThroughMultiDepth(Union::class, [
//Upazila::class => ["upazila_id", "id"],
//District::class => ["district_id", "id"]
//]);
}
