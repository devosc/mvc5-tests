<?php
/**
 *
 */

namespace Mvc5\Test\Request\Exception;

use Exception;
use Mvc5\Request\Exception\Create;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Create::class, new Create('foo', 'bar'));
    }

    /**
     *
     */
    function test_invoke()
    {
        $create = new Create('foo', 'bar');

        $this->assertInstanceOf(Request::class, $create(new Request, new Exception));
    }
}
