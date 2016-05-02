<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Arg;
use Mvc5\Response\Error\BadRequest;
use Mvc5\Test\Response\Response;
use Mvc5\Route\Error\Status;
use Mvc5\Test\Test\TestCase;

class StatusTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $status = new Status;

        $error = new BadRequest;

        $response = new Response;

        $this->assertInstanceOf(Response::class, $status($response, $error));

        $this->assertEquals($error[Arg::STATUS], $response->status());
    }
}
