<?php
/**
 *
 */

namespace Mvc5\Test\Log;

use Mvc5\Log\Error;
use Mvc5\Test\Test\TestCase;

class ErrorTest
    extends TestCase
{
    /**
     *
     */
    function test_error_log()
    {
        $log = new Error;

        $this->assertTrue($log('Hello!'));
    }
}
