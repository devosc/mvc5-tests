<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
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

        $request  = new HttpRequest;
        $response = new HttpResponse;

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $new = $version($request, $response, $next);

        $this->assertNotEquals($response, $new);
        $this->assertNull($new->version());
    }
}
