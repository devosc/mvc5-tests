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
    public function test_construct()
    {
        $this->assertInstanceOf(Dispatch::class, new Dispatch('foo'));
    }

    /**
     *
     */
    public function test_args()
    {
        $dispatch = new Dispatch('foo');

        $this->assertTrue(is_array($dispatch->args()));
    }

    /**
     *
     */
    public function test_invoke_response()
    {
        $dispatch = new Dispatch('foo', new Response);

        $this->assertInstanceOf(Response::class, $dispatch(function($response) { return $response; }));
    }

    /**
     *
     */
    public function test_invoke_error()
    {
        $dispatch = new Dispatch('foo');

        $this->assertInstanceOf(Config::class, $dispatch(function() { return new Config; }));
    }

    /**
     *
     */
    public function test_invoke_not_response()
    {
        $dispatch = new Dispatch('foo');

        $this->assertEquals('foo', $dispatch(function() { return 'foo'; }));
    }
}
