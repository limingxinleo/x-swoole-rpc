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

    /**
     * @desc   返回Swoole Server实例
     * @author limx
     * @return swoole_server
     */
    public function getServer();

    /**
     * @desc   TCP客户端连接的唯一标识符
     * @author limx
     * @return int
     */
    public function getFd();

    /**
     * @desc   TCP连接所在的Reactor线程ID
     * @author limx
     * @return int
     */
    public function getReactorId();
}
