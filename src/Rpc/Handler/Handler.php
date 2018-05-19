<?php
// +----------------------------------------------------------------------
// | Handler.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Xin\Swoole\Rpc\Handler;

use swoole_server;

abstract class Handler implements HanderInterface
{
    protected $server;

    protected $fd;

    protected $reactorId;

    public function __construct(swoole_server $server, $fd, $reactorId)
    {
        $this->server = $server;
        $this->fd = $fd;
        $this->reactorId = $reactorId;
    }

    public function getServer()
    {
        return $this->server;
    }

    public function getFd()
    {
        return $this->fd;
    }

    public function getReactorId()
    {
        return $this->reactorId;
    }
}
