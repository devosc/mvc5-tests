<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Plug;
use Mvc5\Plugin\Plugin;
use Mvc5\Resolvable;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ResolvableTest
    extends TestCase
{
    /**
     *
     */
    public function test_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->once())
             ->method('solve')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->resolvableTest($resolvable));
    }

    /**
     *
     */
    public function test_resolvable_not()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['resolvable', 'resolvableTest']);

        $this->assertEquals('foo', $mock->resolvableTest('foo'));
    }

    /**
     *
     */
    public function test_resolvable_recursion()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $mock->configure('foo', new Plugin(Model\CallObject::class));

        $plugin = new Plug('foo');

        $this->assertInstanceOf(Model\CallObject::class, $mock->resolvableTest($plugin));
    }

    /**
     *
     */
    public function test_resolvable_recursion_exception()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['signal', 'resolvable', 'resolvableTest']);

        $resolvable = $this->getCleanMock(Resolvable::class);

        $mock->expects($this->any())
             ->method('solve')
             ->will($this->returnArgument(0));

        $this->setExpectedException('RuntimeException');

        $mock->resolvableTest($resolvable);
    }
}
