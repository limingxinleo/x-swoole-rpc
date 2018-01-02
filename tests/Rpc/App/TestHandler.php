<?php
// +----------------------------------------------------------------------
// | TestHandler.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Rpc\App;

use Xin\Swoole\Rpc\Handler\HanderInterface;
use Xin\Traits\Common\InstanceTrait;

class TestHandler implements HanderInterface
{
    use InstanceTrait;

    public function returnString()
    {
        return 'success';
    }

    public function returnTrue()
    {
        return true;
    }

    public function returnArray()
    {
        return [
            'key' => 'val'
        ];
    }

    public function hasArguments($name)
    {
        return "hi, {$name}";
    }

    public function recvTimeout()
    {
        sleep(2);
        return 'runtime is 2 seconds';
    }
}
