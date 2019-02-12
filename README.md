# 簡介

[![Latest Version](https://img.shields.io/github/release/nox0121/eloquent-volumeable.svg?style=flat-square)](https://github.com/nox0121/eloquent-volumeable/releases)
[![Build Status](https://img.shields.io/travis/nox0121/eloquent-volumeable.svg?style=flat-square)](https://travis-ci.org/nox0121/eloquent-volumeable)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/nox0121/eloquent-volumeable.svg?style=flat-square)](https://packagist.org/packages/nox0121/eloquent-volumeable)

This package provides a trait that support volumeable behaviour to an Eloquent model.

## Installation

You can install the package via composer:

```bash
composer require nox0121/eloquent-volumeable
```

## Usage

``` php
use Nox0121\EloquentVolumeable\Volumeable;
use Nox0121\EloquentVolumeable\VolumeableTrait;

class MyModel extends Eloquent implements Volumeable
{
    use VolumeableTrait;

    public $volumeable = [
        'volume_column_name' => 'volume_column'
    ];

    ...
}
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
