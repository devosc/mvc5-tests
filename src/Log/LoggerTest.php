<?php
/**
 *
 */

namespace Mvc5\Test\Log;

use Mvc5\Log\Logger;
use Mvc5\Test\Test\TestCase;

class LoggerTest
    extends TestCase
{
    /**
     *
     */
    function test_message()
    {
        $logger = new Logger;

        $this->assertEquals('foo', $logger(function() { return 'foo'; }));
        $this->assertEquals('foo', $logger(function($message) { return $message; }));
    }

    /**
     *
     */
    function test_throw_exception_false()
    {
        $logger = new Logger;

        $this->assertFalse($logger(function($throw_exception = false) { return $throw_exception; }));
    }

    /**
     *
     */
    function test_throw_exception_true()
    {
        $logger = new Logger(true);

        $this->assertTrue($logger(function($throw_exception) { return $throw_exception; }));
    }
}
