<?php
/**
 *
 */

namespace Mvc5\Test\Status;

use Mvc5\Arg;
use Mvc5\Http\Error\ServerError;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Response\Status;
use Mvc5\Test\Test\TestCase;

class StatusTest
    extends TestCase
{
    /**
     *
     */
    function test_error()
    {
        $status = new Status;

        $response = $status(new HttpRequest([Arg::ERROR => new ServerError]), new HttpResponse);

        $this->assertEquals('500',                   $response[Arg::STATUS]);
        $this->assertEquals('Internal Server Error', $response[Arg::REASON]);
    }

    /**
     *
     */
    function test_ok()
    {
        $status = new Status;

        $response = $status(new HttpRequest, new HttpResponse);

        $this->assertEquals(Arg::HTTP_OK, $response[Arg::STATUS]);
        $this->assertEquals('OK',         $response[Arg::REASON]);
    }
}
