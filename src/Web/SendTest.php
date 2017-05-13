<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Send;

class SendTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $send = new Send;

        $request  = new HttpRequest;
        $response = new HttpResponse;

        $next = function(HttpRequest $request, HttpResponse $response) {
            return $response;
        };

        $this->assertEquals($response, $send($request, $response, $next));
    }
}
