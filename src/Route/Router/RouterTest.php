<?php

namespace Mvc5\Test\Route\Router;

use Mvc5\Route\Config;
use Mvc5\Route\Definition\RouteDefinition;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class RouterTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $definition = $this->getCleanMock(RouteDefinition::class);

        $router = new Router($definition);

        $this->assertInstanceOf(Router::class, $router);
    }

    /**
     *
     */
    public function test_create()
    {
        $mock = $this->getCleanMock(Router::class, ['create', 'testCreate']);

        $definition = new RouteDefinition(['regex' => 'foo']);

        $this->assertEquals($definition, $mock->testCreate($definition));
    }

    /**
     *
     */
    public function test_create_without_definition()
    {
        $mock = $this->getCleanMock(Router::class, ['create', 'testCreate']);

        $mock->expects($this->once())
             ->method('definition')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testCreate([]));
    }

    /**
     *
     */
    public function test_dispatch()
    {
        $definition = $this->getCleanMock(RouteDefinition::class);

        $definition->expects($this->once())
                   ->method('children')
                   ->willReturn([]);

        $route = $this->getCleanMock(Route::class);

        $mock = $this->getCleanMock(Router::class, ['dispatch', 'testDispatch']);

        $mock->expects($this->once())
             ->method('match')
             ->willReturn($route);

        $this->assertEquals(null, $mock->testDispatch($route, $definition));
    }

    /**
     *
     */
    public function test_dispatch_matched()
    {
        $definition = $this->getCleanMock(RouteDefinition::class);

        $definition->expects($this->once())
                   ->method('name')
                   ->willReturn('foo');

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('name')
              ->willReturn(false);

        $route->expects($this->once())
              ->method('set');

        $route->expects($this->once())
              ->method('matched')
              ->willReturn(true);

        $mock = $this->getCleanMock(Router::class, ['dispatch', 'testDispatch']);

        $mock->expects($this->once())
             ->method('match')
             ->willReturn($route);

        $this->assertInstanceOf(Route::class, $mock->testDispatch($route, $definition));
    }

    /**
     *
     */
    public function test_dispatch_with_children()
    {
        $definition = $this->getCleanMock(RouteDefinition::class);

        $definition->expects($this->once())
                   ->method('children')
                   ->willReturn(['baz' => []]);

        $route = new Config;

        $mock = $this->getCleanMock(Router::class, ['dispatch', 'testDispatch']);

        $mock->expects($this->any())
             ->method('match')
             ->will($this->onConsecutiveCalls($route, new Config([Route::MATCHED => true])));

        $mock->expects($this->once())
             ->method('create')
             ->willReturn($this->getCleanMock(RouteDefinition::class));

        $this->assertInstanceOf(Route::class, $mock->testDispatch($route, $definition));
    }

    /**
     *
     */
    public function test_name()
    {
        $mock = $this->getCleanMock(Router::class, ['name', 'testName'], [['name' => 'foo']]);

        $this->assertEquals('foo', $mock->testName());
    }

    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Router::class, ['__invoke']);

        $definition = $this->getCleanMock(RouteDefinition::class);

        $mock->expects($this->once())
             ->method('dispatch')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('create')
             ->willReturn($definition);

        $route = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->__invoke($route));
    }
}
