<?php

namespace Mvc5\Test\Url;

use Mvc5\Route\Definition;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $route = $this->getCleanMock(Route::class);

        $this->getCleanMock(Plugin::class, [], [$route, function(){}]);
    }

    /**
     *
     */
    public function test_generator()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['generator', 'generatorTest']);

        $this->assertEquals(null, $mock->generatorTest());
    }

    /**
     *
     */
    public function test_url()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['url', 'urlTest']);

        $mock->expects($this->once())
             ->method('generator')
             ->willReturn(function(){});

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->urlTest('foo'));
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Plugin|Mock $mock */

        $route = $this->getCleanMock(Route::class);

        $route->expects($this->once())
              ->method('name');

        $route->expects($this->once())
              ->method('params')
              ->willReturn([]);

        $mock = $this->getCleanMock(Plugin::class, ['__invoke', '__invoke'], [$route, function(){}]);

        $mock->expects($this->once())
             ->method('url')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->__invoke());
    }
}
