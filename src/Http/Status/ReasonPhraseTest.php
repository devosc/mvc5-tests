<?php
/**
 *
 */

namespace Mvc5\Test\Http\Status;

use Mvc5\Test\Test\TestCase;

class StatusCodeTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $reasonPhrase = new ReasonPhrase;

        $this->assertEquals('OK', $reasonPhrase->statusReasonPhrase('200'));
    }
}
