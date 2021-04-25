# Laravel Macros: Eloquent | `insertAsModel`

This package will add `insertAsModel` macro to Laravel's Eloquent Builder class.

Unlike `insert`, `insertAsModel` method will ensure that all inserted values will go through models' casts and mutators then it will just pass it to the `insert` method.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-macros/eloquent-insert-as-model.svg?style=flat-square)](https://packagist.org/packages/laravel-macros/eloquent-insert-as-model)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/laravel-macros/eloquent-insert-as-model/run-tests?label=tests)](https://github.com/laravel-macros/eloquent-insert-as-model/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/laravel-macros/eloquent-insert-as-model/Check%20&%20fix%20styling?label=code%20style)](https://github.com/laravel-macros/eloquent-insert-as-model/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-macros/eloquent-insert-as-model.svg?style=flat-square)](https://packagist.org/packages/laravel-macros/eloquent-insert-as-model)

## Installation

You can install the package via composer:

```bash
composer require laravel-macros/eloquent-insert-as-model
```

## Usage

Assuming you have:

``` php
class User extends Model
{
     protected $casts = [
        'options' => 'json',
        'shelf'   => 'collection',
    ];
}
```

Normally if you will use the `Model::insert` method to insert a batch of entries, casts and mutators will be ignored and you will have to stringify the values yourself.

Using this package, you can insert values the same way you use `Model::create`, where all the proper casting and mutating logic will be applied.

``` php
User::insertAsModel([
    [
        'options' => ['sms' => true],
        'shelf'   => collect(['book1', 'book2', 'book3']),
    ],
    [
        'options' => ['sms' => false],
        'shelf'   => collect(['book1', 'book2']),
    ],
]);
```

This will prevent you from doing hacks like `'options' => json_encode(['sms' => true])`.

> Note: `insertAsModel` is not a multiple `create` calls. It will insert entries directly to the database (just like `insert`). For example it won't fire models events.

## Testing

```bash
composer test

# Test Coverage with XDebug enabled
composer test-coverage
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Mohannad Najjar](https://github.com/MohannadNaj)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
