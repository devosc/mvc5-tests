<?php
/**
 *
 */

namespace Mvc5\Test\Route\Exception;

use Mvc5\Route\Exception\Create;
use Mvc5\Route\Exception;
use Mvc5\Route\Exception\Route;
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
        /** @var Exception|Mock $route */

        $route = $this->getCleanMock(Exception::class);

        $route->expects($this->any())
              ->method('set');

        /** @var Create|Mock $mock */

        $mock = $this->getCleanMock(Create::class, ['__invoke'], [$route]);

        $this->assertEquals($route, $mock->__invoke(new \Exception, new Route));
    }
}
