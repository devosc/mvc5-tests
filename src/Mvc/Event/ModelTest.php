<?php
/**
 *
 */

namespace Mvc5\Test\Mvc\Event;

use Mvc5\Config;
use Mvc5\Response\Response;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        new Model(null, new Config);
    }

    /**
     *
     */
    public function test_controller()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['controller', 'controllerTest']);

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('controller')
              ->willReturn('foo');

        $mock->expects($this->once())
             ->method('route')
             ->willReturn($route);

        $this->assertEquals('foo', $mock->controllerTest());
    }

    /**
     *
     */
    public function test_model()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['model', 'modelTest']);

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('content')
                 ->willReturn('foo');

        $mock->expects($this->once())
             ->method('response')
             ->willReturn($response);

        $this->assertEquals('foo', $mock->modelTest());
    }

    /**
     *
     */
    public function test_model_set()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['model', 'modelTest']);

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setContent');

        $mock->expects($this->once())
             ->method('response')
             ->willReturn($response);

        $this->assertEquals('foo', $mock->modelTest('foo'));
    }

    /**
     *
     */
    public function test_response()
    {
        /** @var Model|Mock $mock */

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('offsetGet')
               ->willReturn('foo');

        $mock = $this->getCleanMock(Model::class, ['response', 'responseTest'], [null, $config]);

        $this->assertEquals('foo', $mock->responseTest());
    }

    /**
     *
     */
    public function test_route()
    {
        /** @var Model|Mock $mock */

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('offsetGet')
               ->willReturn('foo');

        $mock = $this->getCleanMock(Model::class, ['route', 'routeTest'], [null, $config]);

        $this->assertEquals('foo', $mock->routeTest());
    }

    /**
     *
     */
    public function test_route_set()
    {
        /** @var Model|Mock $mock */

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('offsetSet');

        $mock = $this->getCleanMock(Model::class, ['route', 'routeTest'], [null, $config]);

        /** @var Route $route */
        $route = $this->getCleanMock(Route::class);

        $this->assertEquals($route, $mock->routeTest($route));
    }
}
