<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Error;
use Mvc5\Test\Response\Error\Config;
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
        $dispatch = new Dispatch('foo');

        $this->assertTrue(is_array($dispatch->args()));
    }

    /**
     *
     */
    function test_invoke_response()
    {
        $dispatch = new Dispatch('foo', new Response);

        $this->assertInstanceOf(Response::class, $dispatch(function($response) { return $response; }));
    }

    /**
     *
     */
    function test_invoke_error()
    {
        $dispatch = new Dispatch('foo');

        $this->assertInstanceOf(Config::class, $dispatch(function() { return new Config; }));
    }

    /**
     *
     */
    function test_invoke_not_response()
    {
        $dispatch = new Dispatch('foo');

        $this->assertEquals('foo', $dispatch(function() { return 'foo'; }));
    }
}
