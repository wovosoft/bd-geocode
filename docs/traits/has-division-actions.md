# HasDivisionActions Trait

## Usage

Inject the trait in your controller.

```php
use Wovosoft\BdGeocode\Traits\HasDivisionActions;
```

This trait contains the full CRUD operation methods.

- store
- update
- options
- index
- destroy
- districts
- upazilas
- unions

## store

```php
public function store(Request $request): JsonResponse
```

| Title       | Description                              |
|-------------|------------------------------------------|
| HTTP Method | PUT                                      |
| Operation   | validates and stores user submitted data |

## update

```php
public function update(Division $division, Request $request): JsonResponse
```

| Title           | Description                               |
|-----------------|-------------------------------------------|
| HTTP Method     | PUT                                       |
| Operation       | validates and updates user submitted data |
| Route Parameter | division                                  |


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

## options

Return Records as Options

