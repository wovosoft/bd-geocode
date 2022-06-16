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

```php
public function store(Request $request): JsonResponse
```

| Title       | Description                              |
|-------------|------------------------------------------|
| HTTP Method | PUT                                      |
| Operation   | validates and stores user submitted data |

## update

```php
public function update(District $district, Request $request): JsonResponse
```

| Title           | Description                               |
|-----------------|-------------------------------------------|
| HTTP Method     | PUT                                       |
| Operation       | validates and updates user submitted data |
| Route Parameter | `district`                                |

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
public function destroy(District $district): JsonResponse
```

| Title        | Description                            |
|--------------|----------------------------------------|
| HTTP Method  | DELETE                                 |
| Operation    | Deletes a record                       |
| Route Params | `district` : `number` (id of district) |

## division

```php
public function division(Division $district): ?Division
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | Division under which a district exits  |
| Route Params   | `district` : `number` (id of district) |

## upazilas

```php
public function upazilas(District $district, Request $request): Collection
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | List of upazilas under a district      |
| Route Params   | `district` : `number` (id of district) |
| Request Params | `filter` : `string`                    |

## unions

```php
public function unions(District $district, Request $request): Collection
```

| Title          | Description                            |
|----------------|----------------------------------------|
| HTTP Method    | POST                                   |
| Returns        | List of unions under a district        |
| Route Params   | `district` : `number` (id of district) |
| Request Params | `filter` : `string`                    |
