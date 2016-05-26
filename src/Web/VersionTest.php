<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Web\Version;
use Mvc5\Test\Test\TestCase;

class VersionTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $version = new Version;

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $this->assertEquals($response, $version($request, $response, $next));
    }
}
