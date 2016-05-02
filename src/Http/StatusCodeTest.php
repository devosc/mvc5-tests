<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Test\Test\TestCase;

class StatusCodeTest
    extends TestCase
{
    /**
     *
     */
    function test_statusCode()
    {
        $statusCode = new StatusCode;

        $this->assertEquals('OK', $statusCode->statusCode('200'));
    }
}
