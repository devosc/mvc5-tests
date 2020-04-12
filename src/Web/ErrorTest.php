<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Error;

final class ErrorTest
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

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $this->assertEquals($response, $error($request, $response, $next));
    }
}
