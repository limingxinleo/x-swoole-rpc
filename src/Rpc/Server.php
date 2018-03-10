<?php
// +----------------------------------------------------------------------
// | Server.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Swoole\Rpc;

use Xin\Cli\Color;
use swoole_server;
use Xin\Swoole\Rpc\Exceptions\RpcException;
use Xin\Swoole\Rpc\Handler\HanderInterface;

class Server
{
    public $host;

    public $port;

    public $config;

    public $services = [];

    /** @var  LoggerInterface */
    public $logger;

    public $debug = true;

    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }

    public function setHandler($service, HanderInterface $hander)
    {
        $this->services[$service] = $hander;
        return $this;
    }

    public function setLoggerHandler(LoggerInterface $logger)
    {
        $this->logger = $logger;
        return $this;
    }

    public function serve($host, $port, $config = [])
    {
        if (!extension_loaded('swoole')) {
            echo Color::error('The swoole extension is not installed');
            return;
        }

        $this->host = $host;
        $this->port = intval($port);
        $this->config = $config;

        set_time_limit(0);
        $server = new swoole_server($this->host, $this->port);

        $server->set($config);

        $server->on('receive', [$this, 'receive']);
        $server->on('workerStart', [$this, 'workerStart']);

        $this->beforeServerStart($server);

        $server->start();
    }

    public function beforeServerStart(swoole_server $server)
    {
        echo Color::colorize("-------------------------------------------", Color::FG_LIGHT_GREEN) . PHP_EOL;
        echo Color::colorize("     Socket服务器开启 端口：{$this->port}     ", Color::FG_LIGHT_GREEN) . PHP_EOL;
        echo Color::colorize("-------------------------------------------", Color::FG_LIGHT_GREEN) . PHP_EOL;
    }

    public function workerStart(swoole_server $server, $workerId)
    {
    }

    public function receive(swoole_server $server, $fd, $reactor_id, $data)
    {
        try {
            $data = json_decode($data, true);
            $service = $data['service'];
            $method = $data['method'];
            $arguments = $data['arguments'];

            if (!isset($this->services[$service])) {
                throw new RpcException('The service handler is not exist!');
            }

            $result = $this->services[$service]->$method(...$arguments);
            $response = $this->success($result);
            $server->send($fd, json_encode($response));

            if ($this->debug && $this->logger && $this->logger instanceof LoggerInterface) {
                $this->logger->info($data, $response);
            }
        } catch (\Exception $ex) {
            $response = $this->fail($ex->getCode(), $ex->getMessage());
            $server->send($fd, json_encode($response));

            if ($this->logger && $this->logger instanceof LoggerInterface) {
                $this->logger->error($data, $response, $ex);
            }
        }
    }

    public function success($result)
    {
        return [
            Enum::SUCCESS => true,
            Enum::DATA => $result,
        ];
    }

    public function fail($code, $message)
    {
        return [
            Enum::SUCCESS => false,
            Enum::ERROR_CODE => $code,
            Enum::ERROR_MESSAGE => $message,
        ];
    }
}
