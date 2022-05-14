# Laravel ACS API Wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/gdinko/acs.svg?style=flat-square)](https://packagist.org/packages/gdinko/acs)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/gdinko/acs/run-tests?label=tests)](https://github.com/gdinko/acs/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/gdinko/acs/Check%20&%20fix%20styling?label=code%20style)](https://github.com/gdinko/acs/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/gdinko/acs.svg?style=flat-square)](https://packagist.org/packages/gdinko/acs)


[ACS JSON API Documentation](https://acscourier-media.azureedge.net/production-media/1leezfnu/new_acs_web_services-english.pdf?v=1)

[ACS JSON API Swagger UI](https://webservices.acscourier.net/ACSRestServices/swagger/ui/index)

## Installation

You can install the package via composer:

```bash
composer require gdinko/acs
```

If you plan to use database for storing nomenclatures:

```bash
php artisan migrate
```

If you need to export configuration file:

```bash
php artisan vendor:publish --provider="gdinko\acs\AcsServiceProvider" --tag=config
```

## Configuration

```bash
ACS_API_KEY=
ACS_COMPANY_ID=
ACS_COMPANY_PASSWORD=
ACS_USER_ID=
ACS_USER_PASSWORD=
ACS_BILLING_CODE=
ACS_API_BASE_URL= #default=https://webservices.acscourier.net/ACSRestServices/api/ACSAutoRest/
ACS_API_TIMEOUT= #default=5
```

## Usage

```php
/** 
 * You can call all methods from the API like this , there is no need 
 * to pass company data every time. The data is injected automaticaly 
 * on every request
 **/

dd(Acs::ACS_Address_Validation([
    'Address' => 'Address ...'
]));

dd(Acs::ACS_Trackingsummary([
    'Voucher_No' => '999999999'
]));
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

If you discover any security related issues, please email dinko359@gmail.com instead of using the issue tracker.

## Credits

-   [Dinko Georgiev](https://github.com/gdinko)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.