<?php

declare(strict_types=1);
/**
 * This file is part of laravel-line-notify.
 *
 * @link     https://github.com/fcorz/laravel-line-notify
 * @document https://github.com/fcorz/laravel-line-notify/blob/master/README.md
 * @contact  fengchenorz@gmail.com
 */

namespace fcorz\WechatNotification\Tests;

use Fcorz\LaravelLineNotify\LaravelLineMessage;
use Orchestra\Testbench\TestCase;

/**
 * @internal
 * @coversNothing
 */
class LaravelNotifyMessageTest extends TestCase
{
    public function testNotifyMessage()
    {
        $message = (new LaravelLineMessage())->message('hello world');
        $this->assertEquals('hello world', $message->message);
    }
}
