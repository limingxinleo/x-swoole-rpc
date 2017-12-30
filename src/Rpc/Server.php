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

class Server
{
    public $host;

    public $port;

    public $config;

    public function serve($host, $port, $config = [])
    {
        if (!extension_loaded('swoole')) {
            echo Color::error('The swoole extension is not installed');
            return;
        }

        $this->host = $host;
        $this->port = $port;
        $this->config = $config;

        set_time_limit(0);
        $server = new swoole_server($host, $port);

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
    }
}
