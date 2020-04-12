<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Status;

final class StatusTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $status = new Status;

        $request  = new HttpRequest;
        $response = new HttpResponse;

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $new = $status($request, $response, $next);

        $this->assertNotEquals($response, $new);
        $this->assertEquals(200, $new->status());
        $this->assertEquals('OK', $new->reason());
    }
}
