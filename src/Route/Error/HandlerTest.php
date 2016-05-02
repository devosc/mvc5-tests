<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Response\Error\BadRequest;
use Mvc5\Response\Error\NotFound;
use Mvc5\Route\Error\Handler;
use Mvc5\Test\Test\TestCase;

class HandlerTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $handler = new Handler;

        $this->assertInstanceOf(BadRequest::class, $handler(new BadRequest));
    }

    /**
     *
     */
    function test_invoke_not_found()
    {
        $handler = new Handler;

        $this->assertInstanceOf(NotFound::class, $handler());
    }
}
