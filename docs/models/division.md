# Divisions

This model provides divisions.

## Fetch Districts

You can get the list of districts under a certain division by:

```php
\Wovosoft\BdGeocode\Models\Division::query()->find(7)?->districts
```

## Fetch Upazilas

```php
\Wovosoft\BdGeocode\Models\Division::query()->find(7)?->upazilas
```

## Fetch Unions

```php
\Wovosoft\BdGeocode\Models\Division::query()->find(7)?->unions
```
