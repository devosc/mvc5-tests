<?php

namespace Mvc5\Test\Route\Match;

use Mvc5\Route\Match\Match;
use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $definition = $this->getCleanMock(Definition::class);
        $route      = $this->getCleanMock(Route::class);

        $this->assertInstanceOf(Match::class, new Match($definition, $route));
    }

    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsMatch::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }

    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Match::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test__invoke_no_result()
    {
        $mock = $this->getCleanMock(Match::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn(false);

        $mock->expects($this->once())
             ->method('stop');

        $this->assertEquals(false, $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test__invoke_with_route()
    {
        $mock = $this->getCleanMock(Match::class, ['__invoke']);

        $route = $this->getCleanMock(Route::class);

        $mock->expects($this->once())
            ->method('args')
            ->willReturn([]);

        $mock->expects($this->once())
            ->method('signal')
            ->willReturn($route);

        $this->assertEquals($route, $mock->__invoke(function() {}));
    }
}
