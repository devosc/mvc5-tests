<?php

namespace Mvc5\Test\Route;

use Mvc5\Route\Definition;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class MatchTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $definition = $this->getCleanMock(Definition::class);
        $route      = $this->getCleanMock(Route::class);

        $this->getCleanMock(Match::class, [], [$definition, $route]);
    }

    /**
     *
     */
    public function test_args()
    {
        /** @var Match $mock */

        $mock = $this->getCleanMock(Match::class, ['args', 'argsTest']);

        $this->assertTrue(is_array($mock->argsTest()));
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Match|Mock $mock */

        $mock = $this->getCleanMock(Match::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $route = $this->getCleanMock(Route::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($route);

        $this->assertEquals($route, $mock->__invoke(function(){}));
    }

    /**
     *
     */
    public function test_invoke_not_route()
    {
        /** @var Match|Mock $mock */

        $mock = $this->getCleanMock(Match::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function(){}));
    }
}
