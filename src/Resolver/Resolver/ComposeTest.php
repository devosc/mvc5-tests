<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\App;
use Mvc5\Service\Container;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ComposeTest
    extends TestCase
{
    /**
     *
     */
    public function test_compose_service_manager()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['compose', 'composeTest']);

        $app = $this->getCleanMock(App::class);

        $app->expects($this->once())
            ->method('plugin')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->composeTest($app, ['foo']));
    }

    /**
     *
     */
    public function test_compose_container()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['compose', 'composeTest']);

        $container = $this->getCleanMock(Container::class);

        $container->expects($this->once())
            ->method('offsetGet')
            ->willReturn('bar');

        $mock->expects($this->once())
            ->method('plugin')
            ->willReturn('baz');

        $this->assertEquals('baz', $mock->composeTest($container, ['foo']));
    }

    /**
     *
     */
    public function test_compose_array()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['compose', 'composeTest']);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('baz');

        $this->assertEquals('baz', $mock->composeTest(['foo' => 'bar'], ['foo']));
    }
}
