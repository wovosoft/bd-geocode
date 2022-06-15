# HasDistrictActions Trait

## Usage

Inject the trait in your controller.

```php
use Wovosoft\BdGeocode\Traits\HasDistrictActions;
```

This trait contains the full CRUD operation methods.

- store
- update
- options
- index
- destroy
- division
- upazilas
- unions

## store

This method validates and stores user submitted data.

#### Method : PUT

#### Data Format

```php
[
    "name"      => ["string", "required"],
    "bn_name"   => ["string", "nullable"],
    "lat"       => ["string", "nullable"],
    "lon"       => ["string", "nullable"],
    "url"       => ["string", "nullable"]
]
```

#### On Success Returns,

```php
[
    "id" => $item->id,
    "message" => "Successfully Done"
] 
```

#### On Failure Returns,

```php
[
    "message" => $exception->getMessage()
] 
```
