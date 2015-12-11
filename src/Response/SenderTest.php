<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class SenderTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        /** @var Sender|Mock $mock */

        $mock = $this->getCleanMock(Sender::class, ['exception', 'exceptionTest']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->exceptionTest(new \Exception, $response));
    }

    /**
     *
     */
    public function test_send()
    {
        /** @var Sender|Mock $mock */

        $mock = $this->getCleanMock(Sender::class, ['send', 'sendTest']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->sendTest($response));
    }
}
