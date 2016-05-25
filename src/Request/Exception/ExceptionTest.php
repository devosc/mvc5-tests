<?php
/**
 *
 */

namespace Mvc5\Test\Request\Exception;

use Mvc5\Request\Exception;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Exception::class, new Exception('foo', 'bar'));
    }

    /**
     *
     */
    function test_invoke()
    {
        $exception = new Exception('foo', 'bar');

        $this->assertInstanceOf(Request::class, $exception(new Request, new \Exception));
    }
}
