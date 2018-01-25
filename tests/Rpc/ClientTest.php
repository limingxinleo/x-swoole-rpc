<?php
// +----------------------------------------------------------------------
// | ClientTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Rpc;

use Tests\Rpc\App\TestClient;
use Tests\TestCase;

class ClientTest extends TestCase
{
    public function testStringCase()
    {
        $this->assertEquals('success', TestClient::getInstance()->returnString());
    }

    public function testHasArguments()
    {
        $result = TestClient::getInstance()->hasArguments('limx');
        $this->assertEquals('hi, limx', $result);
    }
}