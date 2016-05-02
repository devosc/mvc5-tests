<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Response\Response;
use Mvc5\Test\Test\TestCase;

class MvcTest
    extends TestCase
{
    /**
     * @return Mvc
     */
    protected function mvc()
    {
        return new Mvc(null, [
            Arg::REQUEST  => new Request,
            Arg::RESPONSE => new Response
        ]);
    }

    /**
     *
     */
    function test_args()
    {
        $this->assertTrue(is_array($this->mvc()->args()));
    }

    /**
     *
     */
    function test_invoke()
    {
        $mvc = $this->mvc();

        $this->assertEquals('bar', $mvc(function($foo) { return $foo; }, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_invoke_false()
    {
        $mvc = $this->mvc();

        $this->assertEquals(false, $mvc(function($foo) { return $foo; }, ['foo' => false]));
    }

    /**
     *
     */
    function test_invoke_request()
    {
        $mvc = $this->mvc();

        $this->assertInstanceOf(Request::class, $mvc(function($request) { return $request; }));
    }

    /**
     *
     */
    function test_invoke_response()
    {
        $mvc = $this->mvc();

        $this->assertInstanceOf(Response::class, $mvc(function($response) { return $response; }));
    }
}
