# Union

Provides Unions

## Example

```php
use \Wovosoft\BdGeocode\Models\Union;

$union = Union::query()->first();

$union->division;   //returns the division under which the union exists
$union->district;   //returns the district under which the union exists
$union->upazila;    //returns the upazila under which the union exists
```

## Relations

```php
public function upazila(): BelongsTo
public function district(): HasOneThrough
public function division(): BelongsTo
```

The example given at the top, uses these relations to return the division, district and upazila using magic props. But
in case you need to modify the final query, use the laravel approach to do so.

```php
use \Wovosoft\BdGeocode\Models\Union;

$union= Union::query()->first();

$union->division()->search('rang')->get();   //or other eloquent operations like paginate 
$union->district()->search('thak')->get();   //or other eloquent operations like paginate
$union->upazila()->search('ruh')->get();     //or other eloquent operations like paginate
```

