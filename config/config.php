<?php

declare(strict_types=1);
/**
 * This file is part of laravel-line-notify.
 *
 * @link     https://github.com/fcorz/laravel-line-notify
 * @document https://github.com/fcorz/laravel-line-notify/blob/master/README.md
 * @contact  fengchenorz@gmail.com
 */
return [
    'channel_access_token' => env('LINE_NOTIFY_KEY', ''),
    'channel_secret'       => env('LINE_NOTIFY_SECRET', ''),
    'redirect_uri'         => env('LINE_NOTIFY_REDIRECT_URI', ''),
];
