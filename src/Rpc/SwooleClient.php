<?php
// +----------------------------------------------------------------------
// | SwooleClient.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Swoole\Rpc;

use swoole_client;
use Xin\Swoole\Rpc\Exceptions\RpcException;

class SwooleClient implements SwooleClientInterface
{
    public $client;

    protected $timeout = 0.1;

    protected static $_instances = [];

    public static function getInstance($service, $host, $port, $options = [])
    {
        if (isset(static::$_instances[$service]) && static::$_instances[$service] instanceof static) {
            return static::$_instances[$service];
        }

        return static::$_instances[$service] = new static($host, $port, $options);
    }

    public function __construct($host, $port, $options = [])
    {
        $client = new swoole_client(SWOOLE_SOCK_TCP);

        if (isset($options['timeout']) && is_numeric($options['timeout'])) {
            $this->timeout = $options['timeout'];
        }

        if (!$client->connect($host, $port, $this->timeout)) {
            throw new RpcException("connect failed. Error: {$client->errCode}");
        }
        $this->client = $client;
    }

    public function handle($data)
    {
        $this->client->send(json_encode($data));
        return $this->client->recv();
    }
}
