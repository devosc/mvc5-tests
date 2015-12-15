<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver\Model\CallEvent;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ListenerTest
    extends TestCase
{
    /**
     *
     */
    public function test_listener_not_event()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['listener', 'listenerTest']);

        $this->assertEquals('foo', $mock->listenerTest('foo'));
    }
    /**
     *
     */
    public function test_listener_event()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['listener', 'listenerTest']);

        $this->assertInstanceOf(\Closure::class, $mock->listenerTest(new CallEvent));
    }
}
