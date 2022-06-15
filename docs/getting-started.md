# Courtesy

The package uses the data from
[https://github.com/nuhil/bangladesh-geocode](https://github.com/nuhil/bangladesh-geocode)

Special thanks to the Author of the package for his awesome job.

## Installation

Via Composer

```shell
composer require wovosoft/bd-geocode
```

## Run Migration

```shell
php artisan migrate
```

## Clone Data

Run the bellow command to clone data
from [https://github.com/nuhil/bangladesh-geocode](https://github.com/nuhil/bangladesh-geocode)
to `storage_path('app/public/bangladesh-geocode')` . You can delete this folder after data seeding is completed.

```shell 
php artisan bd-geocode:clone-data
```

## Import Data to Database

Run the bellow command to import the cloned data to database.

```shell
php artisan bd-geocode:import-data
```
