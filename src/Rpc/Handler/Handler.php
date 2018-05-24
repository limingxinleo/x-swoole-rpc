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
    /** @var swoole_server */
    protected $server;

    /** @var int TCP客户端连接的唯一标识符 */
    protected $fd;

    /** @var int TCP连接所在的Reactor线程ID */
    protected $reactorId;

    public function __construct(swoole_server $server, $fd, $reactorId)
    {
        $this->server = $server;
        $this->fd = $fd;
        $this->reactorId = $reactorId;
    }
}
