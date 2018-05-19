<?php
// +----------------------------------------------------------------------
// | HanderInterface.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Swoole\Rpc\Handler;

use swoole_server;

interface HanderInterface
{

    /**
     * HanderInterface constructor.
     * @param swoole_server $server
     * @param integer       $fd
     * @param integer       $reactorId
     */
    public function __construct(swoole_server $server, $fd, $reactorId);
}
