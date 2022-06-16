# Divisions

This model provides divisions.

## Example

```php
use \Wovosoft\BdGeocode\Models\Division;

$division = \Wovosoft\BdGeocode\Models\Division::query()->findOrFail(7);

$division->districts;
$division->upazilas;
$division->unions;
```

## Relations

```php
public function districts(): HasMany
public function upazilas(): HasManyThrough
public function unions(): Builder
```

The first method can be used to access districts by magic property.

```php
use \Wovosoft\BdGeocode\Models\Division;

$division = \Wovosoft\BdGeocode\Models\Division::query()->findOrFail(7);

$division->districts;
```

But if you need to modify the list of districts, then call the method directly it will give you instance of `HasMany`
which supports all Eloquent Builder methods. So, now you can modify the query here.

```php
use \Wovosoft\BdGeocode\Models\Division;

$division = \Wovosoft\BdGeocode\Models\Division::query()->findOrFail(7);

$division->districts()->where('name','like','%thak%')->get(); //->paginate() etc
//or
$division->districts()->search("thak")->get(); //->paginate() etc
```

The above theory is applicable for upazilas and unions as well.
