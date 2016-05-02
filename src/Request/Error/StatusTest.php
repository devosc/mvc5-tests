<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Response\Error\BadRequest;
use Mvc5\Test\Response\Response;
use Mvc5\Request\Error\Status;
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

        $this->assertEquals($response, $status($response, $error));
        $this->assertEquals($error->status(), $response->status());
    }
}
