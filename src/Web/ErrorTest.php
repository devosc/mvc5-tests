<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Web\Error;
use Mvc5\Test\Test\TestCase;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $error = new Error('error', 'error\controller');

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $this->assertEquals($response, $error($request, $response, $next));
    }
}
