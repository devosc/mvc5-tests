<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Http\Error\NotFound;
use Mvc5\Request\Error;
use Mvc5\Request\HttpRequest;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ CONTROLLER, ERROR, NAME };

final class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test_error()
    {
        $error = new Error('error', 'error/controller');

        $request = new HttpRequest([
            NAME => 'home', CONTROLLER => 'Home\Controller', ERROR => new NotFound
        ]);

        $request = $error($request);

        $this->assertEquals('error',            $request[NAME]);
        $this->assertEquals('error/controller', $request[CONTROLLER]);
    }

    /**
     *
     */
    function test_no_error()
    {
        $error = new Error('error', 'error/controller');

        $request = new HttpRequest([
            NAME => 'home', CONTROLLER => 'Home\Controller'
        ]);

        $request = $error($request);

        $this->assertEquals('home',            $request[NAME]);
        $this->assertEquals('Home\Controller', $request[CONTROLLER]);
    }
}
