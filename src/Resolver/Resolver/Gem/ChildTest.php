<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Child;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_child()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['gem', 'gemTest']);

        $mock->expects($this->once())
            ->method('child')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->gemTest(new Child('foo', 'bar')));
    }
}
