<?php
/**
 *
 */

namespace Mvc5\Test\Response\Prepare;

use Mvc5\Arg;
use Mvc5\Http\Response\StatusCode;
use Mvc5\Request\Config as Request;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class PrepareTest
    extends TestCase
{
    /**
     *
     */
    use StatusCode;

    /**
     *
     */
    function test_prepare()
    {
        $status  = 100;
        $version = '1.1';

        $prepare  = new Prepare;
        $reason   = $this->statusCodeText($status);

        $request  = new Request([Arg::VERSION => $version]);
        $response = new Response(null, $status);

        /** @var Response $response */

        $response = $prepare->prepare($request, $response);

        $this->assertEquals($status,  $response->status());
        $this->assertEquals($reason,  $response->reason());
        $this->assertEquals($version, $response->version());
    }

    /**
     *
     */
    function test_prepare_not_set()
    {
        $status = 200;

        $prepare  = new Prepare;
        $reason   = $this->statusCodeText($status);

        $request  = new Request;
        $response = new Response;

        /** @var Response $response */

        $response = $prepare->prepare($request, $response);

        $this->assertEquals($status, $response->status());
        $this->assertEquals($reason, $response->reason());
        $this->assertEquals(null,    $response->version());
    }

    /**
     *
     */
    function test_invoke()
    {
        $status  = 100;
        $version = '1.0';

        $prepare  = new Prepare;
        $reason   = $this->statusCodeText($status);

        $request  = new Request([Arg::VERSION => $version]);
        $response = new Response(null, $status);

        /** @var Response $response */

        $response = $prepare($request, $response);

        $this->assertEquals($status,  $response->status());
        $this->assertEquals($reason,  $response->reason());
        $this->assertEquals($version, $response->version());
    }
}
