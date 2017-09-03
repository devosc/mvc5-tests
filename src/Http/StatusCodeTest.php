<?php
/**
 *
 */

namespace Mvc5\Test\Http\Status;

use Mvc5\Http\StatusCode;
use Mvc5\Test\Test\TestCase;

class StatusCodeTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->assertEquals('OK', StatusCode::reasonPhrase(200));
    }

    /**
     *
     */
    function test_invalid()
    {
        $this->assertNull(StatusCode::reasonPhrase(5));
    }
}
