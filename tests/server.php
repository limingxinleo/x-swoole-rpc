<?php
// +----------------------------------------------------------------------
// | server.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
require __DIR__ . '/../vendor/autoload.php';

use Xin\Swoole\Rpc\Server;

$server = new Server();
$server->serve('0.0.0.0', '11520', [
    'pid_file' => './socket.pid',
    'daemonize' => false,
    'max_request' => 500, // 每个worker进程最大处理请求次数
]);
