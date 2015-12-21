<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\App;
use Mvc5\Service\Container;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CompositeTest
    extends TestCase
{
    /**
     *
     */
    public function test_composite_service_manager()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['composite', 'compositeTest']);

        $plugin = $this->getCleanMock(App::class);

        $plugin->expects($this->once())
               ->method('plugin')
               ->willReturn('foo');

        $this->assertEquals('foo', $mock->compositeTest($plugin, 'bar'));
    }

    /**
     *
     */
    public function test_composite_service_container()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['composite', 'compositeTest']);

        $plugin = $this->getCleanMock(Container::class);

        $mock->expects($this->once())
             ->method('plugin')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->compositeTest($plugin, 'bar'));
    }

    /**
     *
     */
    public function test_composite_array_access()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['composite', 'compositeTest']);

        $plugin = [
            'bar' => 'baz'
        ];

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->compositeTest($plugin, 'bar'));
    }
}
