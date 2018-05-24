# Swoole RPC Library

[![Build Status](https://travis-ci.org/limingxinleo/x-swoole-rpc.svg?branch=master)](https://travis-ci.org/limingxinleo/x-swoole-rpc)

[Go版本](https://github.com/limingxinleo/go-socket-rpc)

## 安装
~~~
composer require limingxinleo/x-swoole-rpc
~~~

## 使用
服务端示例代码
~~~php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Xin\Swoole\Rpc\Server;

use Xin\Swoole\Rpc\Handler\Handler;

class TestHandler extends Handler
{
    public function test()
    {
        return 'success';
    }
}

$server = new Server();
$server->setHandler('test', TestHandler::class)->serve('0.0.0.0', '11520', [
    'pid_file' => './socket.pid',
    'daemonize' => false,
    'max_request' => 500, // 每个worker进程最大处理请求次数
    'open_eof_check' => true,
    'package_eof' => "\r\n",
]);
~~~

客户端示例代码
~~~php
<?php

use Xin\Swoole\Rpc\Client\Client;

/**
 * Class TestClient
 * @method test
 */
class TestClient extends Client
{
    protected $service = 'test';

    protected $host = '127.0.0.1';

    protected $port = 11520;
}

$result = TestClient::getInstance()->test();
~~~