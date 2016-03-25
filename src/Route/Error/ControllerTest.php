<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Response\Error;
use Mvc5\Route\Error\Controller;
use Mvc5\Route\Config as Route;
use Mvc5\Model\ViewModel;
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

        $mock = $this->getCleanMock(Controller::class, ['__invoke', 'model']);

        $this->assertInstanceOf(ViewModel::class, $mock->__invoke(new Route));
    }

    /**
     *
     */
    public function test_invoke_with_error()
    {
        /** @var Controller|Mock $mock */

        $mock = $this->getCleanMock(Controller::class, ['__invoke', 'model']);

        $error = $this->getCleanMock(Error::class);

        $this->assertInstanceOf(ViewModel::class, $mock->__invoke(new Route, $error));
    }
}
