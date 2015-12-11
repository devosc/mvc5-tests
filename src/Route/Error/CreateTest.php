<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Route\Error\Create;
use Mvc5\Route\Error;
use Mvc5\Route\Error\Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        /** @var Error|Mock $route */

        $route = $this->getCleanMock(Error::class);

        $route->expects($this->any())
              ->method('set');

        /** @var Create|Mock $mock */

        $mock = $this->getCleanMock(Create::class, ['__invoke'], [$route]);

        $this->assertEquals($route, $mock->__invoke(new Route));
    }
}
