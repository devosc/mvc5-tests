<?php

namespace Mvc5\Test\Route\Router;

use Mvc5\Arg;
use Mvc5\Route\Definition;
use Mvc5\Route\Definition\Config;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RouterTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $definition = $this->getCleanMock(Definition::class);

        $this->getCleanAbstractMock(Router::class, ['__construct'], [$definition]);
    }

    /**
     *
     */
    public function test_routeDefinition()
    {
        /** @var Router $mock */

        $mock = $this->getCleanMock(Router::class, ['routeDefinition', 'routeDefinitionTest']);

        $definition = new Config(['regex' => 'foo']);

        $this->assertEquals($definition, $mock->routeDefinitionTest($definition));
    }

    /**
     *
     */
    public function test_create_without_definition()
    {
        /** @var Router|Mock $mock */

        $mock = $this->getCleanMock(Router::class, ['routeDefinition', 'routeDefinitionTest']);

        $mock->expects($this->once())
             ->method('definition')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->routeDefinitionTest([]));
    }

    /**
     *
     */
    public function test_dispatch()
    {
        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->once())
                   ->method('children')
                   ->willReturn([]);

        /** @var Route $route */

        $route = $this->getCleanMock(Route::class);

        /** @var Router|Mock $mock */

        $mock = $this->getCleanMock(Router::class, ['dispatch', 'dispatchTest']);

        $mock->expects($this->once())
             ->method('match')
             ->willReturn($route);

        $this->assertEquals(null, $mock->dispatchTest($route, $definition));
    }

    /**
     *
     */
    public function test_dispatch_match_not_route()
    {
        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        /** @var Route $route */

        $route = $this->getCleanMock(Route::class);

        /** @var Router|Mock $mock */

        $mock = $this->getCleanMock(Router::class, ['dispatch', 'dispatchTest']);

        $mock->expects($this->once())
             ->method('match')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->dispatchTest($route, $definition));
    }

    /**
     *
     */
    public function test_dispatch_matched()
    {
        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->once())
                   ->method('name')
                   ->willReturn('foo');

        /** @var Route|Mock $route */

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('name')
              ->willReturn(false);

        $route->expects($this->once())
              ->method('matched')
              ->willReturn(true);

        /** @var Router|Mock $mock */

        $mock = $this->getCleanMock(Router::class, ['dispatch', 'dispatchTest']);

        $mock->expects($this->once())
             ->method('match')
             ->willReturn($route);

        $this->assertInstanceOf(Route::class, $mock->dispatchTest($route, $definition));
    }

    /**
     *
     */
    public function test_dispatch_with_children()
    {
        /** @var Definition|Mock $definition */

        $definition = $this->getCleanMock(Definition::class);

        $definition->expects($this->once())
                   ->method('children')
                   ->willReturn(['baz' => []]);

        $route = new Route;

        /** @var Router|Mock $mock */

        $mock = $this->getCleanMock(Router::class, ['dispatch', 'dispatchTest']);

        $mock->expects($this->any())
             ->method('match')
             ->will($this->onConsecutiveCalls($route, new Route([Arg::MATCHED => true])));

        $mock->expects($this->once())
             ->method('routeDefinition')
             ->willReturn($this->getCleanMock(Definition::class));

        $this->assertInstanceOf(Route::class, $mock->dispatchTest($route, $definition));
    }

    /**
     *
     */
    public function test_name()
    {
        /** @var Router $mock */

        $mock = $this->getCleanMock(Router::class, ['name', 'nameTest'], [['name' => 'foo']]);

        $this->assertEquals('foo', $mock->nameTest());
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Router|Mock $mock */

        $mock = $this->getCleanMock(Router::class, ['__invoke']);

        $definition = $this->getCleanMock(Definition::class);

        $mock->expects($this->once())
             ->method('dispatch')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('routeDefinition')
             ->willReturn($definition);

        /** @var Route $route */
        $route = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->__invoke($route));
    }
}
