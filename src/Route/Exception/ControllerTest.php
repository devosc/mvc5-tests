<?php
/**
 *
 */

namespace Mvc5\Test\Route\Exception;

use Mvc5\Route\Exception\Controller;
use Mvc5\Route\Exception;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        /** @var Controller|Mock $mock */

        $mock = $this->getCleanMock(Controller::class, ['__invoke'], [[]]);

        /** @var Exception|Mock $route */

        $route = $this->getCleanMock(Exception::class);

        $route->expects($this->once())
              ->method('exception')
              ->willReturn('foo');


        $this->assertEquals(['exception' => 'foo'], $mock->__invoke($route));
    }
}
