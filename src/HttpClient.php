<?php

namespace Openset;

use GuzzleHttp\Client;

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

}
