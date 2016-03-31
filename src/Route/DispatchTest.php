<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Route\Dispatch;
use Mvc5\Response\Error\BadRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        $dispatch = new Dispatch;
        $route    = new Route;

        $this->assertEquals($route, $dispatch(function($route){ return $route; }, [Arg::ROUTE => $route]));
    }

    /**
     *
     */
    public function test_invoke_error()
    {
        $dispatch = new Dispatch;

        $this->assertInstanceOf(BadRequest::class, $dispatch(function(){ return new BadRequest; }));
    }
}
