## Laravel OTA (Over-The-Air) Distribution for iOS

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
<!-- [![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]-->

The package creates the necessary files and routes on your server to cater for the upload of iOS .ipa files and provision the installation of those builds on iOS devices.

### Great, how does it work?

The package allows an integration tool to submit an iOS build to your server - where you can act as the host - the package’s service provider creates the routes that 1) handle the submission of the build which in turn create the necessary manifest files, views, and the download page required for over the air distribution for ios devices, and routes to download the build using those generated files.

Note, since iOS 9, over-the-air distribution requires the https protocol or installation will fail.

## Installation

Require this package with composer:

```shell
composer require "pavankataria/laravel-ota-distribution-ios":"dev-master"
```

After updating composer, add the ServiceProvider to the providers array in config/app.php

### Laravel 5.x:

```php
PavanKataria\OtaDistributionIos\ServiceProvider::class,
```

Run the publish command to finish with the installation, copy the views to the views vendor directory. The routes that serve the build use these views.

```shell
php artisan vendor:publish --provider="PavanKataria\OtaDistributionIos\ServiceProvider"
```

### Lumen:

For Lumen, register a different Provider in `bootstrap/app.php`:

### License

The Laravel OTA Distribution for iOS package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

[ico-version]: https://img.shields.io/packagist/v/pavankataria/laravel-ota-distribution-ios.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/pavankataria/laravel-ota-distribution-ios/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/pavankataria/laravel-ota-distribution-ios.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/pavankataria/laravel-ota-distribution-ios.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pavankataria/laravel-ota-distribution-ios.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/pavankataria/laravel-ota-distribution-ios
[link-travis]: https://travis-ci.org/pavankataria/laravel-ota-distribution-ios
[link-scrutinizer]: https://scrutinizer-ci.com/g/pavankataria/laravel-ota-distribution-ios
[link-code-quality]: https://scrutinizer-ci.com/g/pavankataria/laravel-ota-distribution-ios
[link-downloads]: https://packagist.org/packages/pavankataria/laravel-ota-distribution-ios
[link-author]: https://github.com/pavankataria
[link-contributors]: ../../contributors
