<?php
// +----------------------------------------------------------------------
// | LoggerHandler.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Rpc\App;

use Exception;
use Xin\Swoole\Rpc\LoggerInterface;
use Xin\Traits\Common\InstanceTrait;

class LoggerHandler implements LoggerInterface
{
    use InstanceTrait;

    public function info(array $request, array $response)
    {
        $data = [
            'request' => $request,
            'response' => $response,
        ];

        $file = TESTS_PATH . '/info.log';
        file_put_contents($file, json_encode($data));
    }

    public function error(array $request, array $response, Exception $ex)
    {
        $data = [
            'request' => $request,
            'response' => $response,
        ];

        $file = TESTS_PATH . '/error.log';
        file_put_contents($file, json_encode($data));
    }
}