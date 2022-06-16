# Upazila

Provides Upazilas

## Example

```php
use \Wovosoft\BdGeocode\Models\Upazila;

$upazila= \Wovosoft\BdGeocode\Models\Upazila::query()->first();

$upazila->district; //returns district under which the upazila exists
$upazila->division; //returns division under which the upazila exists
$upazila->unions;   //returns unions under the upazila
```

## Relations

```php
public function division(): HasOneThrough
public function district(): BelongsTo
public function unions(): HasMany
```

The example given at the top, uses these relations to return the division, district and unions using magic props. But in
case you need to modify the final query, use the laravel approach to do so.

```php
use \Wovosoft\BdGeocode\Models\Upazila;

$upazila= Upazila::query()->first();

$upazila->division()->search('rang')->get();   //or other eloquent operations like paginate 
$upazila->district()->search('thak')->get();   //or other eloquent operations like paginate
$upazila->unions()->search('ruh')->get();     //or other eloquent operations like paginate
```
