# Database Notification Channel for Laravel 5.3 and up

[![Latest Version on Packagist](https://img.shields.io/packagist/v/godforhire/databasenotifications.svg?style=flat-square)](https://packagist.org/packages/godforhire/databasenotifications)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/godforhire/databasenotifications.svg?style=flat-square)](https://packagist.org/packages/godforhire/databasenotifications)

This package makes it easy to send database notifications with Laravel 5.3 and up from third-party packages. Those often allow you to send mail or slack notifications, but with this package you can also send them to the notification table.
For others, simply use Laravel's own notifications.

## Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Available Message methods](#available-message-methods)
- [License](#license)

## Installation

You can install the package via composer:

``` bash
composer require godforhire/databasenotifications
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

```php
use godforhire\DatabaseNotifications\DatabaseChannel;
use godforhire\DatabaseNotifications\DatabaseMessage;
use Illuminate\Notifications\Notification;

class BackupHasFailed extends Notification
{
    public function via($notifiable)
    {
        return [DatabaseChannel::class];
    }

    public function toDatabase($notifiable)
    {
        return DatabaseMessage::create()
                    ->user(1)
                    ->data([
                        'event' => 'Backup failed',
                    	'description' => 'Daily backup of Your App has failed: reason, disk S3 is unreachable.',
                    	'...' => '...'
                    ]);
    }
}
```

### Available Message methods

- `user` The user to send the notification to.
- `data` An array with custom fields. This can contain any key value pair you want.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.