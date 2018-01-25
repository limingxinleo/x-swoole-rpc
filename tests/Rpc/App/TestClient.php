<?php
// +----------------------------------------------------------------------
// | TestClient.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Rpc\App;

use Xin\Swoole\Rpc\Client\Client;

/**
 * Class TestClient
 * @package Tests\Rpc\App
 * @method returnString
 * @method hasArguments($name)
 */
class TestClient extends Client
{
    protected $service = 'test';

    protected $host = '127.0.0.1';

    protected $port = 11520;

    const TIMEOUT = 1;
}
