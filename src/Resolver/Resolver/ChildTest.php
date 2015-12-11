<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Child;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    public function test_child()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['child', 'childTest']);

        $mock->expects($this->once())
             ->method('parent')
             ->willReturn(new Plugin(null));

        $mock->expects($this->once())
             ->method('merge')
             ->will($this->returnArgument(0));

        $mock->expects($this->once())
             ->method('provide')
             ->willReturn('baz');

        $this->assertEquals('baz', $mock->childTest(new Child('foo', 'bar')));
    }
}
