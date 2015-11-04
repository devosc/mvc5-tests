<?php

namespace Mvc5\Test\Mvc;

use Mvc5\Config\Configuration;
use Mvc5\Response\Response;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test_controller()
    {
        $mock = $this->getCleanMock(Base::class, ['controller', 'testController']);

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('controller')
              ->willReturn('foo');

        $mock->expects($this->once())
             ->method('route')
             ->willReturn($route);

        $this->assertEquals('foo', $mock->testController());
    }

    /**
     *
     */
    public function test_model()
    {
        $mock = $this->getCleanMock(Base::class, ['model', 'testModel']);

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('content')
                 ->willReturn('foo');

        $mock->expects($this->once())
             ->method('response')
             ->willReturn($response);

        $this->assertEquals('foo', $mock->testModel());
    }

    /**
     *
     */
    public function test_response()
    {
        $config = $this->getCleanMock(Configuration::class);

        $config->expects($this->once())
               ->method('get')
               ->willReturn('foo');

        $mock = $this->getCleanMock(Base::class, ['response', 'testResponse'], [$config]);

        $this->assertEquals('foo', $mock->testResponse());
    }

    /**
     *
     */
    public function test_route()
    {
        $config = $this->getCleanMock(Configuration::class);

        $config->expects($this->once())
               ->method('get')
               ->willReturn('foo');

        $mock = $this->getCleanMock(Base::class, ['route', 'testRoute'], [$config]);

        $this->assertEquals('foo', $mock->testRoute());
    }

    /**
     *
     */
    public function test_setModel()
    {
        $mock = $this->getCleanMock(Base::class, ['setModel', 'testSetModel']);

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setContent');

        $mock->expects($this->once())
             ->method('response')
             ->willReturn($response);

        $this->assertEquals(null, $mock->testSetModel(null));
    }

    /**
     *
     */
    public function test_setResponse()
    {
        $config = $this->getCleanMock(Configuration::class);

        $config->expects($this->once())
               ->method('set');

        $mock = $this->getCleanMock(Base::class, ['setResponse', 'testSetResponse'], [$config]);

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals(null, $mock->testSetResponse($response));
    }

    /**
     *
     */
    public function test_setRoute()
    {
        $config = $this->getCleanMock(Configuration::class);

        $config->expects($this->once())
               ->method('set');

        $mock = $this->getCleanMock(Base::class, ['setRoute', 'testSetRoute'], [$config]);

        $route = $this->getCleanMock(Route::class);

        $this->assertEquals(null, $mock->testSetRoute($route));
    }
}
