<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Http\Request\Config as HttpRequest;
use Mvc5\Http\Response\Config as HttpResponse;
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

        $this->assertEquals('foo', $dispatch(new HttpRequest, new HttpResponse));
    }
}
