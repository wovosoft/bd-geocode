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

```php
public function options(Request $request): Collection|array
```

| Title          | Description                                                                                                              |
|----------------|--------------------------------------------------------------------------------------------------------------------------|
| HTTP Method    | POST                                                                                                                     |
| Returns        | Filterable records as list                                                                                               |
| Request Params | `filter`:`string` , <br>`cols` :`array` (default: `["id", "name", "bn_name", "url"]`),<br>`limit`:`number` (default: 25) |

## index

```php
public function index(Request $request): LengthAwarePaginator
```

| Title          | Description                                                                                        |
|----------------|----------------------------------------------------------------------------------------------------|
| HTTP Method    | POST                                                                                               |
| Returns        | Records as Datatable with Pagination                                                               |
| Request Params | `filter`:`string` ,<br>`per_page`:`number` (default: 15),<br> `current_page`:`number` (default: 1) |

## destroy

```php
public function destroy(Division $division): JsonResponse
```

| Title        | Description                            |
|--------------|----------------------------------------|
| HTTP Method  | DELETE                                 |
| Operation    | Deletes a record                       |
| Route Params | `division` : `number` (id of division) |

## districts

```php
public function districts(Division $division, Request $request): Collection
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | List of districts under a division     |
| Route Params   | `division` : `number` (id of division) |
| Request Params | `filter` : `string`                    |

## upazilas

```php
public function upazilas(Division $division, Request $request): Collection
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | List of upazilas under a division      |
| Route Params   | `division` : `number` (id of division) |
| Request Params | `filter` : `string`                    |

## unions

```php
public function unions(Division $division, Request $request): Collection
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | List of unions under a division        |
| Route Params   | `division` : `number` (id of division) |
| Request Params | `filter` : `string`                    |
