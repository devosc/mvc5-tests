<?php
/**
 *
 */

namespace Mvc5\Test\Request\Error;

use Mvc5\Http\Error\NotFound;
use Mvc5\Request\Error;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Error::class, new Error('foo', 'bar'));
    }

    /**
     *
     */
    function test_invoke()
    {
        $error = new Error('foo', 'bar');

        $this->assertInstanceOf(Request::class, $error(new Request, new NotFound));
    }
}
