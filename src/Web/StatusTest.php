<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Web\Status;
use Mvc5\Test\Test\TestCase;

class StatusTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $status = new Status;

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $this->assertEquals($response, $status($request, $response, $next));
    }
}
