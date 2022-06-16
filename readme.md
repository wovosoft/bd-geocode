# BdGeocode

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

## Installation

Via Composer

```shell
composer require wovosoft/bd-geocode
```

## Publish Migrations

If you need to modify default migrations, then run

```shell
php artisan vendor:publish --tag=bd-geocode.migrations
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


## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email wovosoft@email.com instead of using the issue tracker.

## Credits

- [Narayan Adhikary](https://github.com/wovosoft)
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

## Courtesy

The package uses the data from
[https://github.com/nuhil/bangladesh-geocode](https://github.com/nuhil/bangladesh-geocode)

Special thanks to the Author of the package for his awesome job.


[ico-version]: https://img.shields.io/packagist/v/wovosoft/bd-geocode.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/wovosoft/bd-geocode.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/wovosoft/bd-geocode/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/wovosoft/bd-geocode
[link-downloads]: https://packagist.org/packages/wovosoft/bd-geocode
[link-travis]: https://travis-ci.org/wovosoft/bd-geocode
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/wovosoft
[link-contributors]: ../../contributors
