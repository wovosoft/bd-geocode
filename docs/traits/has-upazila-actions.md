# HasUpazilaActions Trait

## Usage

Inject the trait in your controller.

```php
use Wovosoft\BdGeocode\Traits\HasUpazilaActions;
```

This trait contains the full CRUD operation methods.

- store
- update
- options
- index
- destroy
- division
- district
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
public function update(Upazila $upazila, Request $request): JsonResponse
```

| Title           | Description                               |
|-----------------|-------------------------------------------|
| HTTP Method     | PUT                                       |
| Operation       | validates and updates user submitted data |
| Route Parameter | upazila                                   |

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
public function destroy(Upazila $upazila): JsonResponse
```

| Title        | Description                          |
|--------------|--------------------------------------|
| HTTP Method  | DELETE                               |
| Operation    | Deletes a record                     |
| Route Params | `upazila` : `number` (id of upazila) |

## division

```php
public function division(Upazila $upazila): ?Division
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | Division under which the upazila exits |
| Route Params   | `upazila` : `number` (id of upazila)   |

## district

```php
public function district(Upazila $upazila): ?District
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | District under which the upazila exits |
| Route Params   | `upazila` : `number` (id of upazila)   |

## unions

```php
public function unions(int $upazila, Request $request): Collection
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | List of unions under a division        |
| Route Params   | `upazila` : `upazila` (id of division) |
| Request Params | `filter` : `string`                    |
