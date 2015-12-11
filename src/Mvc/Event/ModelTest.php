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
    public function test_response()
    {
        /** @var Model|Mock $mock */

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('get')
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
               ->method('get')
               ->willReturn('foo');

        $mock = $this->getCleanMock(Model::class, ['route', 'routeTest'], [null, $config]);

        $this->assertEquals('foo', $mock->routeTest());
    }

    /**
     *
     */
    public function test_setModel()
    {
        /** @var Model|Mock $mock */

        $mock = $this->getCleanMock(Model::class, ['setModel', 'setModelTest']);

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setContent');

        $mock->expects($this->once())
             ->method('response')
             ->willReturn($response);

        $mock->setModelTest(null);
    }

    /**
     *
     */
    public function test_setResponse()
    {
        /** @var Model|Mock $mock */

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('set');

        $mock = $this->getCleanMock(Model::class, ['setResponse', 'setResponseTest'], [null, $config]);

        /** @var Response $response */

        $response = $this->getCleanMock(Response::class);

        $mock->setResponseTest($response);
    }

    /**
     *
     */
    public function test_setRoute()
    {
        /** @var Model|Mock $mock */

        $config = $this->getCleanMock(Config::class);

        $config->expects($this->once())
               ->method('set');

        $mock = $this->getCleanMock(Model::class, ['setRoute', 'setRouteTest'], [null, $config]);

        /** @var Route $route */
        $route = $this->getCleanMock(Route::class);

        $mock->setRouteTest($route);
    }
}
