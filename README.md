# AWS Pinpoint Laravel Notification Channel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kielabokkie/aws-pinpoint-laravel-notification-channel.svg?style=flat-square)](https://packagist.org/packages/kielabokkie/aws-pinpoint-laravel-notification-channel)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/kielabokkie/aws-pinpoint-laravel-notification-channel/master.svg?style=flat-square)](https://travis-ci.org/kielabokkie/aws-pinpoint-laravel-notification-channel)
[![StyleCI](https://styleci.io/repos/209686103/shield)](https://styleci.io/repos/209686103)
[![Quality Score](https://img.shields.io/scrutinizer/g/kielabokkie/aws-pinpoint-laravel-notification-channel.svg?style=flat-square)](https://scrutinizer-ci.com/g/kielabokkie/aws-pinpoint-laravel-notification-channel)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/kielabokkie/aws-pinpoint-laravel-notification-channel/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/kielabokkie/aws-pinpoint-laravel-notification-channel/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/kielabokkie/aws-pinpoint-laravel-notification-channel.svg?style=flat-square)](https://packagist.org/packages/kielabokkie/aws-pinpoint-laravel-notification-channel)

This package makes it easy to send notifications using [AwsPinpoint](https://aws.amazon.com/pinpoint/) with Laravel 5.5+ and 6.0.

**Note: Currently only SMS is supported. Other message types like voice and email are on the roadmap. Please get in touch if you would like to help out with this.**

Send SMS using AWS Pinpoint the easy way.


## Contents

- [Installation](#installation)
	- [Setting up the AwsPinpoint service](#setting-up-the-AwsPinpoint-service)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer by running the command below

```
composer require kielabokkie/aws-pinpoint-laravel-notification-channel
```

### Setting up the AwsPinpoint service

This package uses the [AWS Service Provider for Laravel](https://github.com/aws/aws-sdk-php-laravel) package. You'll need to add specific configuration for AWS Pinpoint to your `config/aws.php` file. See the example below:

```
...
'Pinpoint' => [
    'region' => env('AWS_PINPOINT_REGION'),
    'application_id' => env('AWS_PINPOINT_APPLICATION_ID'),
    'sender_id' => env('AWS_PINPOINT_SENDER_ID'),
    'key' => env('AWS_PINPOINT_KEY'),
    'secret' => env('AWS_PINPOINT_SECRET'),
],
...
```

And then add the following entries in your `.env` file:

```
...
AWS_PINPOINT_REGION=
AWS_PINPOINT_APPLICATION_ID=
AWS_PINPOINT_SENDER_ID=
AWS_PINPOINT_KEY=
AWS_PINPOINT_SECRET=
...
```

## Usage

Once everything is setup you can send a notification as follows:

```php
<?php

namespace App\Notifications;

use App\User;
use Illuminate\Notifications\Notification;
use NotificationChannels\AwsPinpoint\AwsPinpointChannel;
use NotificationChannels\AwsPinpoint\AwsPinpointSmsMessage;

class PhoneVerificationCreated extends Notification
{
    /**
     * Get the notification's delivery channels.
     *
     * @param \App\User $notifiable
     * @return array
     */
    public function via(User $notifiable)
    {
        return [AwsPinpointChannel::class];
    }

    /**
     * Send SMS via AWS Pinpoint.
     *
     * @param \App\User $notifiable
     * @return \NotificationChannels\AwsPinpoint\AwsPinpointSmsMessage
     */
    public function toAwsPinpoint(User $notifiable)
    {
        $message = sprintf('Your order %s has been dispatched', $this->orderId);

        return (new AwsPinpointSmsMessage($message))
            ->setRecipients($notifiable->mobile_number);
    }
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email kielabokkie@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Wouter Peschier](https://github.com/kielabokkie)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
