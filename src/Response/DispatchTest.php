<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Http\Error as HttpError;
use Mvc5\Http\Error\Config as Error;
use Mvc5\Request\Config as Request;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Dispatch::class, new Dispatch('foo'));
    }

    /**
     *
     */
    function test_args()
    {
        $dispatch = new Dispatch('foo', new Request, new Response);

        $this->assertTrue(is_array($dispatch->args()));
    }

    /**
     *
     */
    function test_invoke_response()
    {
        $dispatch = new Dispatch('foo', new Request, new Response);

        $this->assertInstanceOf(Response::class, $dispatch(function($response) { return $response; }));
    }

    /**
     *
     */
    function test_invoke_error()
    {
        $dispatch = new Dispatch('foo', new Request, new Response);

        $this->assertInstanceOf(HttpError::class, $dispatch(function() { return new Error; }));
    }

    /**
     *
     */
    function test_invoke_not_response()
    {
        $dispatch = new Dispatch('foo', new Request, new Response);

        $this->assertEquals('foo', $dispatch(function() { return 'foo'; }));
    }
}
