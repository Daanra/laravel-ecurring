# Laravel eCurring

[![Latest Version on Packagist](https://img.shields.io/packagist/v/daanra/laravel-ecurring.svg?style=flat-square)](https://packagist.org/packages/daanra/laravel-ecurring)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/daanra/laravel-ecurring/run-tests?label=tests)](https://github.com/daanra/laravel-ecurring/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/daanra/laravel-ecurring.svg?style=flat-square)](https://packagist.org/packages/daanra/laravel-ecurring)


A package for interacting with [eCurring's](https://www.ecurring.com/) API. Their API documentation can be found [here](https://docs.ecurring.com).

## Installation

You can install the package via composer:

```bash
composer require daanra/laravel-ecurring
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Daanra\Ecurring\EcurringServiceProvider" --tag="config"
```

## Usage

``` php
$skeleton = new Spatie\Skeleton();
echo $skeleton->echoPhrase('Hello, Spatie!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Daan Raatjes](https://github.com/daanra)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
