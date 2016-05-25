<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Http\Error\BadRequest as Error;
use Mvc5\Request\Error\Controller;
use Mvc5\Request\Error\Model;
use Mvc5\Request\Config as Request;
use Mvc5\Model\ViewModel;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $controller = new Controller(new Model);

        $this->assertInstanceOf(ViewModel::class, $controller(new Request));
    }

    /**
     *
     */
    function test_invoke_with_error()
    {
        $controller = new Controller(new Model);

        $this->assertInstanceOf(ViewModel::class, $controller(new Request, new Error));
    }
}
