<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Http\HttpError;
use Mvc5\Request\HttpRequest;
use Mvc5\Response\HttpResponse;
use Mvc5\Response\Dispatch;
use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    function test_any_response()
    {
        $dispatch = new Dispatch('foo', new HttpRequest, new HttpResponse);

        $this->assertEquals('foo', $dispatch(function() { return 'foo'; }));
    }

    /**
     *
     */
    function test_error()
    {
        $dispatch = new Dispatch('foo', new HttpRequest, new HttpResponse);

        $this->assertInstanceOf(HttpError::class, $dispatch(function() { return new HttpError; }));
    }

    /**
     *
     */
    function test_request()
    {
        $dispatch = new Dispatch('foo', new HttpRequest, new HttpResponse);

        $this->assertInstanceOf(HttpRequest::class, $dispatch(function($request) { return $request; }));
    }

    /**
     *
     */
    function test_response()
    {
        $dispatch = new Dispatch('foo', new HttpRequest, new HttpResponse);

        $this->assertInstanceOf(HttpResponse::class, $dispatch(function($response) { return $response; }));
    }
}
