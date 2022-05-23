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
php artisan vendor:publish --tag=acs-config
```

If you need to export migrations:

```bash
php artisan vendor:publish --tag=acs-migrations
```

If you need to export models:

```bash
php artisan vendor:publish --tag=acs-models
```

If you need to export commands:

```bash
php artisan vendor:publish --tag=acs-commands
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

Runtime Setup

```php
Acs::setTimeout(99);
```

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

Commands

```bash

#get acs api status (use -h to view options)
php artisan acs:api-status

#track parcels (use -h to view options)
php artisan acs:track
```

Models

```php
CarrierAcsTracking
CarrierAcsApiStatus
```

Events

```php
CarrierAcsTrackingEvent
```

## Parcels Tracking

1. Subscribe to tracking event, you will recieve last tracking info, if tracking command is schduled

```php
Event::listen(function (CarrierAcsTrackingEvent $event) {
    echo $event->account;
    dd($event->tracking);
});
```

2. Before use of tracking command you need to create your own command and define setUp method

```bash
php artisan make:command TrackCarrierAcs
```

3. In app/Console/Commands/TrackCarrierAcs define your logic for parcels to be tracked

```php
use Gdinko\Acs\Commands\TrackCarrierAcsBase;

class TrackCarrierAcsSetup extends TrackCarrierAcsBase
{
    protected function setup()
    {
        //define parcel selection logic here
        // $this->parcels = [];
    }
}
```

4. Use the command

```bash
php artisan acs:track
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
-   [silabg.com](https://www.silabg.com/) :heart:
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
