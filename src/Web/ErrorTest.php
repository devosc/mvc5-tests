<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Error;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $error = new Error('error', 'error\controller');

        $request  = new HttpRequest;
        $response = new HttpResponse;

        $next = function(HttpRequest $request, HttpResponse $response) {
            return $response;
        };

        $this->assertEquals($response, $error($request, $response, $next));
    }
}
