<?php
/**
 *
 */

namespace Mvc5\Test\Status;

use Mvc5\Arg;
use Mvc5\Http\Error\ServerError;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Response\Status;
use Mvc5\Test\Test\TestCase;

class StatusTest
    extends TestCase
{
    /**
     *
     */
    function test_ok()
    {
        $status = new Status;

        $response = $status(new Request, new Response);

        $this->assertEquals(Arg::HTTP_OK, $response[Arg::STATUS]);
        $this->assertEquals('OK',         $response[Arg::REASON]);
    }

    /**
     *
     */
    function test_error()
    {
        $status = new Status;

        $response = $status(new Request([Arg::ERROR => new ServerError]), new Response);

        $this->assertEquals('500',                   $response[Arg::STATUS]);
        $this->assertEquals('Internal Server Error', $response[Arg::REASON]);
    }
}
