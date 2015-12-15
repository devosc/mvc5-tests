<?php
/**
 *
 */

namespace Mvc5\Test\Route\Exception;

use Mvc5\Route\Exception\Controller;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Controller::class, new Controller([]));
    }

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Controller|Mock $mock */

        $mock = $this->getCleanMock(Controller::class, ['__invoke'], [[]]);

        /** @var Route|Mock $route */

        $route = ['exception' => 'baz'];

        $this->assertEquals(['exception' => 'baz'], $mock->__invoke($route));
    }
}
