<?php
/**
 *
 */

namespace Mvc5\Test\Http\Response;

use Mvc5\Test\Test\TestCase;

class StatusCodeTest
    extends TestCase
{
    /**
     *
     */
    function test_status_code_text()
    {
        $statusCode = new StatusCode;

        $this->assertEquals('OK', $statusCode->statusCodeText('200'));
    }
}
