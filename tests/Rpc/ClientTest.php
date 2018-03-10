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

    public function testLoggerHandlerCase()
    {
        $result = TestClient::getInstance()->hasArguments('limx');
        sleep(1);
        $data = file_get_contents(TESTS_PATH . '/info.log');
        $data = json_decode($data, true);
        $this->assertArrayHasKey('request', $data);
        $this->assertArrayHasKey('response', $data);
        $this->assertEquals($result, $data['response']['data']);
    }

    public function testLoggerhandlerErrorCase()
    {
        try {
            $result = TestClient::getInstance()->exception();
        } catch (\Exception $ex) {
            $this->assertEquals(400, $ex->getCode());
            $this->assertEquals('测试异常', $ex->getMessage());
        }
        sleep(1);
        $data = file_get_contents(TESTS_PATH . '/error.log');
        $data = json_decode($data, true);
        $this->assertArrayHasKey('request', $data);
        $this->assertArrayHasKey('response', $data);
        $this->assertEquals(400, $data['response']['errorCode']);
        $this->assertEquals('测试异常', $data['response']['errorMessage']);
    }
}