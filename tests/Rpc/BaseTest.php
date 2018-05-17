<?php
// +----------------------------------------------------------------------
// | BaseTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Rpc;

use Tests\Rpc\App\Test2Client;
use Tests\Rpc\App\TestClient;
use Tests\TestCase;
use swoole_process;

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

    // public function testRecvTimeout()
    // {
    //     try {
    //         $result = TestClient::getInstance()->recvTimeout();
    //         $this->assertEquals("runtime is 2 seconds", $result);
    //     } catch (\Exception $ex) {
    //         sleep(3);
    //         $this->assertEquals(2, $ex->getCode());
    //     }
    // }

    public function testException()
    {
        try {
            $result = TestClient::getInstance()->exception();
        } catch (\Exception $ex) {
            $this->assertEquals(400, $ex->getCode());
            $this->assertEquals('测试异常', $ex->getMessage());
        }
    }

    public function testManyRequest()
    {
        $time = microtime(true);
        for ($i = 0; $i < 10000; $i++) {
            $result = TestClient::getInstance()->returnTrue();
        }
        $time = microtime(true) - $time;
        $this->assertTrue($time < 10);
    }

    public function testMuitiServiceRequest()
    {
        $time = microtime(true);
        for ($i = 0; $i < 100; $i++) {
            $result = TestClient::getInstance()->getTest2Handler100Times();
        }
        $time = microtime(true) - $time;
        $this->assertTrue($time < 10);
    }
}
