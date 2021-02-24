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

use Fcorz\LaravelLineNotify\Exceptions\HttpException;
use GuzzleHttp\Client;

class LaravelLineNotify
{
    protected $http;

    protected $guzzleOptions = [];

    protected $oauthTokenUrl = 'https://notify-bot.line.me/oauth/token';

    protected $notifyUrl = 'https://notify-api.line.me/api/notify';

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    /**
     * get notify access token.
     * @param $code
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws HttpException
     * @return bool|mixed
     */
    public function getAccessToken($code)
    {
        try {
            $response = $this->getHttpClient()->post($this->oauthTokenUrl, [
                'form_params' => [
                    'code'          => $code,
                    'grant_type'    => 'authorization_code',
                    'redirect_uri'  => config('line.redirect_uri'),
                    'client_id'     => config('line.channel_access_token'),
                    'client_secret' => config('line.channel_secret'),
                ],
            ]);

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * send notify.
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws HttpException
     * @return string
     */
    public function sendNotify(LaravelLineMessage $message, string $token)
    {
        try {
            $response = $this->getHttpClient()->post($this->notifyUrl, $this->payload($message, $token));

            return $response->getBody()->getContents();
        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return array
     */
    protected function payload(LaravelLineMessage $message, string $token)
    {
        return [
            'form_params' => ['message' => $message->message],
            'headers'     => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ];
    }
}
