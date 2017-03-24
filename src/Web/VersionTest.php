<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Version;

class VersionTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $version = new Version;

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $new = $version($request, $response, $next);

        $this->assertNotEquals($response, $new);
        $this->assertNull($new->version());
    }
}
