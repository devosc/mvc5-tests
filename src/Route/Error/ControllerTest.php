<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Response\Error\BadRequest as Error;
use Mvc5\Route\Error\Controller;
use Mvc5\Route\Config as Route;
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
        $controller = new Controller;

        $this->assertInstanceOf(ViewModel::class, $controller(new Route));
    }

    /**
     *
     */
    function test_invoke_with_error()
    {
        $controller = new Controller;

        $this->assertInstanceOf(ViewModel::class, $controller(new Route, new Error));
    }
}
