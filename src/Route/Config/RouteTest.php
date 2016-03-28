<?php
/**
 *
 */

namespace Mvc5\Test\Route\Config;

use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RouteTest
    extends TestCase
{
    /**
     *
     */
    public function test_controller()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['controller']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->controller());
    }

    /**
     *
     */
    public function test_error()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['error']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->error());
    }

    /**
     *
     */
    public function test_hostname()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['hostname']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->hostname());
    }

    /**
     *
     */
    public function test_length()
    {
        $route = new Route(['length' => 2]);

        $this->assertEquals(2, $route->length());
    }

    /**
     *
     */
    public function test_length_zero()
    {
        $route = new Route();

        $this->assertEquals(0, $route->length());
    }

    /**
     *
     */
    public function test_matched()
    {
        $route = new Route(['matched' => true]);

        $this->assertEquals(true, $route->matched());
    }

    /**
     *
     */
    public function test_matched_false()
    {
        $route = new Route();

        $this->assertEquals(false, $route->matched());
    }

    /**
     *
     */
    public function test_method()
    {
        $route = new Route(['method' => 'foo']);

        $this->assertEquals('foo', $route->method());
    }

    /**
     *
     */
    public function test_name()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['name']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->name());
    }

    /**
     *
     */
    public function test_param_not_null()
    {
        $route = new Route([Arg::PARAMS => ['foo' => 'bar']]);

        $this->assertEquals('bar', $route->param('foo'));
    }

    /**
     *
     */
    public function test_param_null()
    {
        $route = new Route();

        $this->assertEquals(null, $route->param('foo'));
    }

    /**
     *
     */
    public function test_params()
    {
        $route = new Route(['params' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $route->params());
    }

    /**
     *
     */
    public function test_params_empty()
    {
        $route = new Route();

        $this->assertEquals([], $route->params());
    }

    /**
     *
     */
    public function test_path()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['path']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->path());
    }

    /**
     *
     */
    public function test_scheme()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['scheme']);

        $mock->expects($this->once())
            ->method('offsetGet')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->scheme());
    }
}
