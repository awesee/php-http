## http
Http request for php

### Requirement

1. PHP >= 5.6
2. **[Composer](https://getcomposer.org/)**

## Installation

```shell
$ composer require openset/http
```

### Usage

```php
<?php

use Openset\HttpClient;

// 修改默认配置（可选）
HttpClient::setConfig(['debug' => false, 'verify' => true]);

// 发送get请求
$resp = HttpClient::get('https://www.example.com/');

// Response对象实现了一个PSR-7接口 Psr\Http\Message\ResponseInterface ， 包含了很多有用的信息。

// 你可以获取这个响应的状态码和和原因短语(reason phrase)：

$code = $resp->getStatusCode(); // 200
$reason = $resp->getReasonPhrase(); // OK
// 你可以从响应获取头信息(header)：

// Check if a header exists.
if ($response->hasHeader('Content-Length')) {
    echo "It exists";
}

// Get a header from the response.
echo $response->getHeader('Content-Length');

// Get all of the response headers.
foreach ($response->getHeaders() as $name => $values) {
    echo $name . ': ' . implode(', ', $values) . "\r\n";
}
// 使用 getBody 方法可以获取响应的主体部分(body)，主体可以当成一个字符串或流对象使用

$body = $resp->getBody();
// Implicitly cast the body to a string and echo it
echo $body;
// Explicitly cast the body to a string
$stringBody = (string) $body;
// Read 10 bytes from the body
$tenBytes = $body->read(10);
// Read the remaining contents of the body as a string
$remainingBytes = $body->getContents();

```

## Contributors

[Your contributions are always welcome!](https://github.com/openset/http/graphs/contributors)

## LICENSE

Released under [MIT](https://github.com/openset/http/blob/master/LICENSE) LICENSE
