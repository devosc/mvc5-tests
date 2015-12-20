<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RelayTest
    extends TestCase
{

    /**
     *
     */
    public function test_relay_none()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['relay', 'relayTest']);

        $mock->expects($this->once())
            ->method('invoke')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->relayTest('foo'));
    }

    /**
     *
     */
    public function test_relay_once()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['relay', 'relayTest']);

        $mock->expects($this->any())
            ->method('invoke')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->relayTest('foo', ['baz']));
    }
}
