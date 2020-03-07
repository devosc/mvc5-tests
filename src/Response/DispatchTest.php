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

        $this->assertEquals('foo', $dispatch(fn() => 'foo'));
    }

    /**
     *
     */
    function test_error()
    {
        $dispatch = new Dispatch('foo', new HttpRequest, new HttpResponse);

        $this->assertInstanceOf(HttpError::class, $dispatch(fn() => new HttpError));
    }

    /**
     *
     */
    function test_request()
    {
        $dispatch = new Dispatch('foo', new HttpRequest, new HttpResponse);

        $this->assertInstanceOf(HttpRequest::class, $dispatch(fn($request) => $request));
    }

    /**
     *
     */
    function test_response()
    {
        $dispatch = new Dispatch('foo', new HttpRequest, new HttpResponse);

        $this->assertInstanceOf(HttpResponse::class, $dispatch(fn($response) => $response));
    }
}
