# [WIP] MediaThor ⚡

MediaThor is a booster packages which makes it easy to get starting with media interactions throughout your project.
Packed with sensible defaults and endless configurability.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dystcz/mediathor.svg?style=flat-square)](https://packagist.org/packages/dystcz/mediathor)
[![Total Downloads](https://img.shields.io/packagist/dt/dystcz/mediathor.svg?style=flat-square)](https://packagist.org/packages/dystcz/mediathor)
![GitHub Actions](https://github.com/dystcz/mediathor/actions/workflows/main.yml/badge.svg)

![](https://media.tenor.com/okRitQnLPD8AAAAC/cosplay-thor.gif)

## Installation

You can install the package via composer:

```bash
composer require dystcz/mediathor
```

Run the installer:
```bash
php artisan mediathor:install
```

<details>
  <summary>You can also install manually:</summary>

  ```bash
# Publish MediaThor config
php artisan vendor:publish --provider="Dystcz\MediaThor\MediaThorServiceProvider" --tag="migrations"
            
# Publish Medialibrary config
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="config"

# Publish Medialibrary migrations
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider" --tag="migrations"

# Publish Filepond config
php artisan vendor:publish --provider="Sopamo\LaravelFilepond\LaravelFilepondServiceProvider"

# Run migrations
php artisan migrate
  ```
</details>

## Features

- [ ] [Filepond](https://pqina.nl/filepond/) media upload
    - [ ] `UploadController`
- [ ] Preconfigured [Glide](https://glide.thephpleague.com/) for image manipulations and Nuxt image
    - [ ] `GlideImageController`
- [ ] [Medialibrary](https://github.com/spatie/laravel-medialibrary) with sensible defaults including:
    - [ ] Image conversions
    - [ ] Responsive images with `srcset`
    - [ ] `MediaResource` for your APIs
    - [ ] Automatic `with` and `height` as `Media` custom properties
    - [ ] `MediaController`

Everything is configurable in `config/mediathor.php`

## Usage

```bash
# Usage
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email jakub@dy.st instead of using the issue tracker.

## Credits

-   [Jakub Theimer](https://github.com/dystcz)
-   [Spatie](https://github.com/spatie) for the `laravel-medialibrary` package
-   [Sopamo](https://github.com/sopamo) for the `laravel-filepond` package
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

