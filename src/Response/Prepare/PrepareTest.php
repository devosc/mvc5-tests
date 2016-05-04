<?php
/**
 *
 */

namespace Mvc5\Test\Response\Prepare;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class PrepareTest
    extends TestCase
{
    /**
     *
     */
    function test_prepare()
    {
        $prepare  = new Prepare;
        $request  = new Request([Arg::VERSION => 'bar']);
        $response = new Response(null, 100);

        /** @var Response $response */

        $response = $prepare->prepare($request, $response);

        $this->assertEquals(100,   $response->status());
        $this->assertEquals('bar', $response->version());
    }

    /**
     *
     */
    function test_prepare_not_set()
    {
        $prepare  = new Prepare;
        $request  = new Request;
        $response = new Response;

        /** @var Response $response */

        $response = $prepare->prepare($request, $response);

        $this->assertEquals(200,   $response->status());
        $this->assertEquals(null,  $response->version());
    }

    /**
     *
     */
    function test_invoke()
    {
        $prepare  = new Prepare;
        $request  = new Request([Arg::VERSION => 'bar']);
        $response = new Response(null, 100);

        /** @var Response $response */

        $response = $prepare($request, $response);

        $this->assertEquals(100,   $response->status());
        $this->assertEquals('bar', $response->version());
    }
}
