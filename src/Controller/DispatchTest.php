<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $dispatch = new Dispatch;

        $this->assertEquals('foo', $dispatch(new Request, new Response));
    }
}
