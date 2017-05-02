<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Http\Error\BadRequest as Error;
use Mvc5\Request\Error\Controller;
use Mvc5\Request\Error\ViewModel;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    function test_controller()
    {
        $controller = new Controller(new ViewModel);

        $this->assertInstanceOf(ViewModel::class, $controller(new Request));
    }

    /**
     *
     */
    function test_controller_with_error()
    {
        $controller = new Controller(new ViewModel);

        $this->assertInstanceOf(ViewModel::class, $controller(new Request, new Error));
    }
}
