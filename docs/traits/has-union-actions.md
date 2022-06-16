# HasUnionActions Trait

## Usage

Inject the trait in your controller.

```php
use Wovosoft\BdGeocode\Traits\HasUnionActions;
```

This trait contains the full CRUD operation methods.

- store
- update
- options
- index
- destroy
- division
- district
- upazila

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
public function update(Union $union, Request $request): JsonResponse
```

| Title           | Description                               |
|-----------------|-------------------------------------------|
| HTTP Method     | PUT                                       |
| Operation       | validates and updates user submitted data |
| Route Parameter | union                                     |

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
public function destroy(Union $union): JsonResponse
```

| Title        | Description                      |
|--------------|----------------------------------|
| HTTP Method  | DELETE                           |
| Operation    | Deletes a record                 |
| Route Params | `union` : `number` (id of union) |

## division

```php
public function division(Union $union): ?Division
```

| Title        | Description                          |
|--------------|--------------------------------------|
| HTTP Method  | POST                                 |
| Returns      | Division under which the union exits |
| Route Params | `union` : `number` (id of union)     |

## district

```php
public function district(Union $union): ?District
```

| Title        | Description                          |
|--------------|--------------------------------------|
| HTTP Method  | POST                                 |
| Returns      | District under which the union exits |
| Route Params | `union` : `number` (id of union)     |

## upazila

```php
public function upazila(Union $union): ?Upazila
```

| Title        | Description                         |
|--------------|-------------------------------------|
| HTTP Method  | POST                                |
| Returns      | Upazila under which the union exits |
| Route Params | `union` : `number` (id of union)    |
