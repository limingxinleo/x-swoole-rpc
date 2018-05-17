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
 * @method returnString()
 * @method hasArguments($name)
 * @method exception()
 * @method bigString($str)
 * @method bigReturnString($str)
 */
class Test2Client extends Client
{
    protected $service = 'test2';

    protected $host = '127.0.0.1';

    protected $port = 11521;

    const TIMEOUT = 1;
}
