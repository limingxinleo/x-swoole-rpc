<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Rpc;

use Tests\Rpc\App\TestClient;
use Tests\TestCase;

class BaseTest extends TestCase
{
    public function testSwooleCase()
    {
        $this->assertTrue(extension_loaded('swoole'));
    }

    public function testReturnString()
    {
        $result = TestClient::getInstance()->returnString();
        $this->assertEquals('success', $result);
    }

    public function testReturnBoolean()
    {
        $result = TestClient::getInstance()->returnTrue();
        $this->assertTrue($result);
    }

    public function testReturnArray()
    {
        $result = TestClient::getInstance()->returnArray();
        $this->assertEquals(['key' => 'val'], $result);
    }

    public function testHasArguments()
    {
        $name = 'limx';
        $result = TestClient::getInstance()->hasArguments($name);
        $this->assertEquals("hi, {$name}", $result);
    }
}
