<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

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
    public function test_invoke()
    {
        $status = new Status;

        $this->assertInstanceOf(Response::class, $status(new Response, new BadRequest));
    }
}
