<?php
// +----------------------------------------------------------------------
// | Client.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Swoole\Rpc\Client;

use Xin\Swoole\Rpc\Exceptions\RpcException;
use Xin\Swoole\Rpc\SwooleClient;

abstract class Client
{
    protected static $_instances = [];

    protected $service;

    protected $host;

    protected $port;

    public function __construct()
    {
        if (!isset($this->service)) {
            throw new RpcException('The service name is required!');
        }

        if (!isset($this->host)) {
            throw new RpcException('The host is required!');
        }

        if (!isset($this->port)) {
            throw new RpcException('The port is required!');
        }
    }

    public static function getInstance()
    {
        $key = get_called_class();

        if (isset(static::$_instances[$key]) && static::$_instances[$key] instanceof static) {
            return static::$_instances[$key];
        }

        return static::$_instances[$key] = new static();
    }

    public static function __callStatic($name, $arguments)
    {
        return static::getInstance()->$name(...$arguments);
    }

    public function __call($name, $arguments)
    {
        $data = $this->getData($name, $arguments);
        $client = SwooleClient::getInstance($this->service, $this->host, $this->port);
        $result = $client->handle($data);
        if ($result = json_decode($result, true)) {
            if (true === $result['success']) {
                return $result['data'];
            }

            throw new RpcException($result['errorMessage'], $result['errorCode']);
        }

        throw new RpcException('未知错误');
    }

    public function getData($name, $arguments)
    {
        return [
            'service' => $this->service,
            'method' => $name,
            'arguments' => $arguments,
        ];
    }
}
