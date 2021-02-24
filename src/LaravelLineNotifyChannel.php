<?php

declare(strict_types=1);
/**
 * This file is part of laravel-line-notify.
 *
 * @link     https://github.com/fcorz/laravel-line-notify
 * @document https://github.com/fcorz/laravel-line-notify/blob/master/README.md
 * @contact  fengchenorz@gmail.com
 */
namespace fcorz\LaravelLineNotify;

use fcorz\WechatNotification\Exceptions\InvalidConfigException;
use Illuminate\Notifications\Notification;

class LaravelLineNotifyChannel
{
    public $notify;

    /**
     * init channel.
     * TemplateChannel constructor.
     * @throws InvalidConfigException
     */
    public function __construct(LaravelLineNotify $notify)
    {
        $this->notify = $notify;
    }

    /**
     * @param $notifiable
     * @throws \Fcorz\LaravelLineNotify\Exceptions\HttpException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($notifiable, Notification $notification)
    {
        if (! $token = $notifiable->routeNotificationFor('line', $notification)) {
            return;
        }
        $message = $notification->toLineNotify($notifiable);
        $this->notify->sendNotify($message, $token);
    }
}
