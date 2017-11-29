# Infobip notification channel for Laravel 5.4 via SMS

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laravel-notification-channels/infobip.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/infobip)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/laravel-notification-channels/infobip/master.svg?style=flat-square)](https://travis-ci.org/laravel-notification-channels/infobip)
[![StyleCI](https://styleci.io/repos/:style_ci_id/shield)](https://styleci.io/repos/:style_ci_id)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/:sensio_labs_id.svg?style=flat-square)](https://insight.sensiolabs.com/projects/:sensio_labs_id)
[![Quality Score](https://img.shields.io/scrutinizer/g/laravel-notification-channels/infobip.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/infobip)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/laravel-notification-channels/infobip/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/laravel-notification-channels/infobip/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel-notification-channels/infobip.svg?style=flat-square)](https://packagist.org/packages/laravel-notification-channels/infobip)

This package makes it easy to send notifications using [Infobip](https://www.infobip.com/) with Laravel 5.4.

With this package you can send SMSs notifications.

## Contents

- [Installation](#installation)
	- [Setting up the Infobip service](#setting-up-the-Infobip-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
composer require laravel-notification-channels/infobip
```

You must install the service provider:

```php
// config/app.php
'providers' => [
    ...
    NotificationChannels\Infobip\InfobipServiceProvider::class,
],
```

### Setting up the Infobip service

To create an Infobip account see [Infobip docs](https://dev.infobip.com/v1/docs)

Add your Infobip REST API key to your `config/services.php`:

```php
// config/services.php
...
'infobip' => [
    'key' => env('INFOBIP_KEY'),
    'apiKey' => env('INFOBIP_API_KEY'),
    'username' => env('INFOBIP_USERNAME'),
    'password' => env('INFOBIP_PASSWORD'),
],
...
```

On production you only need `apiKey` and add `key` for reference.

On development setting `username` and `password` facilitates the API keys management not asking for your credentials
every time.

### Generate an API key

``` bash
php artisan infobip:create-api-key name --permissions=ALL
```

and set `publicApiKey` in `config/services.php` as `apiKey`

### Commands

``` bash
php artisan list infobip
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\Infobip\InfobipChannel;
use NotificationChannels\Infobip\InfobipSmsMessage;
use Illuminate\Notifications\Notification;

class InvoiceGenerated extends Notification
{
    public function via($notifiable)
    {
        return [InfobipChannel::class];
    }

    public function toInfobip($notifiable)
    {
        return (new InfobipSmsMessage())
            ->content("Your {$notifiable->last_invoice} was generated!");
    }
}
```

Infobip channel will look for a `routeNotificationForInfobip` method on your Notifiable model first then
for the `phone_number` or `mobil` attribute of the Notifiable model to get the destination number. Remember
to add the country code.


```php
public function routeNotificationForInfobip()
{
    return '+1' . $this->mobil;
}
```

### Available Message methods

#### InfobipSmsMessage

- `content('')`: Accepts a string value for the notification body.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email ricardo dot ramirez dot r at gmail dot you know instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Ricardo Ramirez R.](https://github.com/RicardoRamirezR)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
