<?php
/**
 *
 */

namespace Mvc5\Test\Route\Config;

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
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['length']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn(2);

        $this->assertEquals(2, $mock->length());
    }

    /**
     *
     */
    public function test_length_zero()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['length']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn(null);

        $this->assertEquals(0, $mock->length());
    }

    /**
     *
     */
    public function test_matched()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['matched']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn(true);

        $this->assertEquals(true, $mock->matched());
    }

    /**
     *
     */
    public function test_matched_false()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['matched']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn(null);

        $this->assertEquals(false, $mock->matched());
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
    public function test_params()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['params']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->params());
    }

    /**
     *
     */
    public function test_params_empty()
    {
        /** @var Route|Mock $mock */

        $mock = $this->getCleanMock(Route::class, ['params']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn(null);

        $this->assertEquals([], $mock->params());
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
