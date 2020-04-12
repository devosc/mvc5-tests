<?php
/**
 *
 */

namespace Mvc5\Test\Response\Status;

use Mvc5\Http\Error\ServerError;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Response\Status;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ ERROR, HTTP_OK, REASON, STATUS };

final class StatusTest
    extends TestCase
{
    /**
     *
     */
    function test_error()
    {
        $status = new Status;

        $response = $status(new HttpRequest([ERROR => new ServerError]), new HttpResponse);

        $this->assertEquals('500',                   $response[STATUS]);
        $this->assertEquals('Internal Server Error', $response[REASON]);
    }

    /**
     *
     */
    function test_ok()
    {
        $status = new Status;

        $response = $status(new HttpRequest, new HttpResponse);

        $this->assertEquals(HTTP_OK, $response[STATUS]);
        $this->assertEquals('OK',         $response[REASON]);
    }
}
