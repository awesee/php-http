<?php

namespace Openset;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class HttpClient
{
    protected static $client;

    public static function getClient()
    {
        if (is_null(self::$client)) {
            self::$client = new Client([
                // You can set any number of default request options.
                'timeout' => 30.0,
            ]);
        }

        return self::$client;
    }

    public static function request($method, $uri = '', array $options = [])
    {
        $response = self::getClient()->request($method, $uri, $options);
        if ($response instanceof ResponseInterface) {
            return $response->getBody();
        }

        return false;
    }

}
