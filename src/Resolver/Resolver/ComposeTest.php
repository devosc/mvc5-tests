<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ComposeTest
    extends TestCase
{
    /**
     *
     */
    public function test_compose_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['compose', 'composeTest']);

        $this->assertEquals('foo', $mock->composeTest('foo'));
    }

    /**
     *
     */
    public function test_compose_once()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['compose', 'composeTest']);

        $mock->expects($this->once())
             ->method('composite')
             ->willReturn('baz');

        $this->assertEquals('baz', $mock->composeTest('foo', ['bar']));
    }
}
