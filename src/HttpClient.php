<?php

namespace Openset;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

/**
 * Class HttpClient
 * @package Openset
 */
class HttpClient
{
    /**
     * @var
     */
    protected static $client;

    /**
     * @return Client
     */
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

    /**
     * @param $method
     * @param string $uri
     * @param array $options
     * @return bool|\Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function request($method, $uri = '', array $options = [])
    {
        $response = self::getClient()->request($method, $uri, $options);
        if ($response instanceof ResponseInterface) {
            return $response->getBody();
        }

        return false;
    }

    /**
     * @param $uri
     * @param array $options
     * @return bool|\Psr\Http\Message\StreamInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function get($uri, array $options = [])
    {
        return self::request('GET', $uri, $options);
    }

    /**
     * @param $method
     * @param array $args
     * @return bool|mixed
     */
    public static function parseJSON($method, array $args)
    {
        $body = call_user_func_array([self::class, $method], $args);
        if ($body instanceof ResponseInterface) {
            $body = $body->getBody();
        }

        if (empty($body)) {
            return false;
        }

        $contents = $body->getContents();
        $res = json_decode($contents, true);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return false;
        }

        return $res;
    }

}
