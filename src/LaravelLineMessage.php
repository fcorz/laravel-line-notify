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

class LaravelLineMessage
{
    /**
     * Message content.
     *
     * @var string
     */
    public $message;

    /**
     * @var string
     */
    public $imageThumbnail;

    /**
     * @var string
     */
    public $imageFullsize;

    /**
     * @var string filename
     */
    public $imageFile;

    /**
     * @var int
     */
    public $stickerPackageId;

    /**
     * @var int
     */
    public $stickerId;

    /**
     * Additional request options for the Guzzle HTTP client.
     *
     * @var array
     */
    public $http = [];

    public function message(string $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Image file url .
     * @return $this
     */
    public function imageUrl(string $full, string $thumb = null)
    {
        $this->imageFullsize  = $full;
        $this->imageThumbnail = $thumb ?: $full;
        return $this;
    }

    /**
     * Path to image which you will upload (jpeg, png, gif).
     * @return $this
     */
    public function imageFile(string $imageFile)
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    /**
     * @return $this
     */
    public function sticker(int $packageId, int $stickerId)
    {
        $this->stickerPackageId = $packageId;
        $this->stickerId        = $stickerId;
        return $this;
    }

    /**
     * @return $this
     */
    public function http(array $http)
    {
        $this->http = $http;
        return $this;
    }
}
