<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Arg;
use Mvc5\Http\Error\NotFound;
use Mvc5\Request\Error;
use Mvc5\Request\HttpRequest;
use Mvc5\Test\Test\TestCase;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test_error()
    {
        $error = new Error('error', 'error/controller');

        $request = new HttpRequest([
            Arg::NAME => 'home', Arg::CONTROLLER => 'Home\Controller', Arg::ERROR => new NotFound
        ]);

        $request = $error($request);

        $this->assertEquals('error',            $request[Arg::NAME]);
        $this->assertEquals('error/controller', $request[Arg::CONTROLLER]);
    }

    /**
     *
     */
    function test_no_error()
    {
        $error = new Error('error', 'error/controller');

        $request = new HttpRequest([
            Arg::NAME => 'home', Arg::CONTROLLER => 'Home\Controller'
        ]);

        $request = $error($request);

        $this->assertEquals('home',            $request[Arg::NAME]);
        $this->assertEquals('Home\Controller', $request[Arg::CONTROLLER]);
    }
}
