<?php

namespace Mvc5\Test\Route\Exception;

use Mvc5\Route\Exception\Config;
use Mvc5\Route\Exception\Create;
use Mvc5\Test\Test\TestCase;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Create::class, new Create($this->getCleanMock(Config::class)));
    }

    /**
     *
     */
    public function test__invoke()
    {
        $route = $this->getCleanMock(Config::class);

        $route->expects($this->any())
              ->method('set');

        $mock = $this->getCleanMock(Create::class, ['__invoke'], [$route]);

        $this->assertInstanceOf(Config::class, $mock->__invoke($route, new \Exception));
    }
}
