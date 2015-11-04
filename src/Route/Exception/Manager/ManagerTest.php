<?php

namespace Mvc5\Test\Route\Exception\Manager;

use Mvc5\Route\Exception\Manager\Manager;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;

class ManagerTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMock(Manager::class, ['exception']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $route = $this->getCleanMock(Route::class);

        $this->assertEquals('foo', $mock->exception($route, new \Exception));
    }
}
