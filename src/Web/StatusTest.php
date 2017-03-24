<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Status;

class StatusTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $status = new Status;

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $new = $status($request, $response, $next);

        $this->assertNotEquals($response, $new);
        $this->assertEquals(200, $new->status());
        $this->assertEquals('OK', $new->reason());
    }
}
