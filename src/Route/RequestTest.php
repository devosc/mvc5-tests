<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class RequestTest
    extends TestCase
{
    /**
     *
     */
    function test_length()
    {
        $request = new Request([Arg::LENGTH => 2]);

        $this->assertEquals(2, $request->length());
    }

    /**
     *
     */
    function test_length_zero()
    {
        $request = new Request;

        $this->assertEquals(0, $request->length());
    }

    /**
     *
     */
    function test_matched()
    {
        $request = new Request([Arg::MATCHED => true]);

        $this->assertTrue($request->matched());
    }

    /**
     *
     */
    function test_matched_false()
    {
        $request = new Request;

        $this->assertFalse($request->matched());
    }

    /**
     *
     */
    function test_request()
    {
        $request = new Request(new Mvc5Request);

        $this->assertEquals(new Mvc5Request, $request->request());
    }
}
