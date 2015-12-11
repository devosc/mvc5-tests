<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Response as MvcResponse;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ResponseTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var MvcResponse|Mock $mock */

        $mock = $this->getCleanMock(MvcResponse::class, ['__invoke']);

        $response = $this->getCleanMock(Response::class);

        $mock->expects($this->once())
             ->method('send')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke($response));
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        /** @var MvcResponse|Mock $mock */

        $mock = $this->getCleanMock(MvcResponse::class, ['__invoke']);

        $response = $this->getCleanMock(Response::class);

        $mock->method('send')
             ->will($this->onConsecutiveCalls($this->throwException(new \Exception), 'foo'));

        $mock->expects($this->once())
             ->method('exception')
             ->willReturn($response);

        $this->assertEquals('foo', $mock->__invoke($response));
    }
}
