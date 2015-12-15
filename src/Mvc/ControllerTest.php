<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Controller;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        /** @var Controller|Mock $mock */

        $mock = $this->getCleanMock(Controller::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('action')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function(){}));
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        /** @var Controller|Mock $mock */

        $mock = $this->getCleanMock(Controller::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('action')
             ->will($this->throwException(new \Exception));

        $mock->expects($this->once())
             ->method('exception')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(function() {}));
    }
}
