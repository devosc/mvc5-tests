<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver\Model\CallEvent;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CallTest
    extends TestCase
{
    /**
     *
     */
    public function test_call_string()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('transmit')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->call('foo'));
    }

    /**
     *
     */
    public function test_call_event()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('event')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->call(new CallEvent));
    }

    /**
     *
     */
    public function test_call_invoke()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['call']);

        $mock->expects($this->once())
             ->method('invoke')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->call(new \stdClass));
    }
}
