<?php

declare(strict_types=1);
/**
 * This file is part of laravel-line-notify.
 *
 * @link     https://github.com/fcorz/laravel-line-notify
 * @document https://github.com/fcorz/laravel-line-notify/blob/master/README.md
 * @contact  fengchenorz@gmail.com
 */
namespace Fcorz\LaravelLineNotify;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fcorz\LaravelLineNotify\LaravelLineNotify
 */
class LaravelLineNotifyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'line-notify';
    }
}
