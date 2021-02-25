<h1 align="center"> laravel-line-notify </h1>
<p align="center">:rainbow:  laravel line notify notification </p>


[![Latest Version on Packagist](https://img.shields.io/packagist/v/fcorz/laravel-line-notify.svg?style=flat-square)](https://packagist.org/packages/fcorz/laravel-line-notify)
[![Build Status](https://travis-ci.org/fcorz/laravel-line-notify.svg?branch=main)](https://travis-ci.org/fcorz/laravel-line-notify)
[![Total Downloads](https://img.shields.io/packagist/dt/fcorz/laravel-line-notify.svg?style=flat-square)](https://packagist.org/packages/fcorz/laravel-line-notify)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

Laravel implements the line notify message notification function. Including the binding of code in exchange for access token and notification channel message push.

## Installation

you can install the package via composer:

``` bash
composer require fcorz/laravel-line-notify
```

publish config

``` bash
php artisan vendor:publish --provider="Fcorz\LaravelLineNotify\LaravelLineNotifyServiceProvider"
```
## Usage

### simple
``` php
// get access_token by code
app('line-notify')->getAccessToken("O97YoWeYMV6vW3uYPFgPAC");

// response
{
   "status":200,
   "message":"access_token is issued",
   "access_token":"1vIvPoq4aG4UOJYoQ6oriAUPvDNxxxxxxxxxxx"
}

// notify
$message = (new LaravelLineMessage())->message('hello world');
app('line-notify')->sendNotify($message, "access_token");
```
### facade
``` php
// get access_token by code
LaravelLineNotifyFacade::getAccessToken("O97YoWeYMV6vW3uYPFgPAC");

// notify
$message = (new LaravelLineMessage())->message('hello world');
LaravelLineNotifyFacade::sendNotify($message, "access_token");
```

### notification
#### user model notifiable
``` php
public function routeNotificationForLine($notification)
{
    return $this->notify_access_token;
}
```

#### create your notification ( you can also not use the queue )
``` php
use App\Models\UserMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;


class LineNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $message;

    public function __construct($message, $delay = 0)
    {
        $this->queue = 'notification';

        $this->delay = $delay;

        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['line'];
    }

    /**
     * @param $notifable
     * @return LineTemplateService
     */
    public function toLineNotify($notifable)
    {
        return (new LaravelLineMessage())->message($this->message);
    }
}
```
#### call notify()
``` php
$receiver->notify(new LineNotification('hello world'));
```

### Security

If you discover any security related issues, please email fengchenorz@gmail.com instead of using the issue tracker.

## Credits

- [fengchen](https://github.com/fcorz)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
