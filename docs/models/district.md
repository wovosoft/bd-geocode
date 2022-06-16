# District

Provides districts

## Example

```php
use \Wovosoft\BdGeocode\Models\District;

$district= \Wovosoft\BdGeocode\Models\District::query()->first();

$district->division;    //returns division under which the district exits
$district->upazilas;    //returns upazilas under the district
$district->unions;      //returns unions under the district
```

## Relations

```php
public function division(): BelongsTo
public function upazilas(): HasMany
public function unions(): HasManyThrough
```

The example given at the top, uses these relations to return the division, upazilas and unions using magic props. But in
case you need to modify the final query, use the laravel approach to do so.

```php
use \Wovosoft\BdGeocode\Models\District;

$district= \Wovosoft\BdGeocode\Models\District::query()->first();

$district->division()->where('id','>',10)->get();   //or other eloquent operations like paginate 
$district->upazilas()->where('id','>',10)->get();   //or other eloquent operations like paginate
$district->unions()->where('id','>',10)->get();     //or other eloquent operations like paginate
```
