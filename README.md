# Swoole RPC Library

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

use Xin\Swoole\Rpc\Handler\HanderInterface;
use Xin\Traits\Common\InstanceTrait;

class TestHandler implements HanderInterface
{
    /** limingxinleo/x-trait-common */
    use InstanceTrait;

    public function test()
    {
        return 'success';
    }
}

$server = new Server();
$server->setHandler('test', TestHandler::getInstance())->serve('0.0.0.0', '11520', [
    'pid_file' => './socket.pid',
    'daemonize' => false,
    'max_request' => 500, // 每个worker进程最大处理请求次数
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