<?php
/**
 *
 */

namespace Mvc5\Test\Log;

use Mvc5\Log\Logger;
use Mvc5\Test\Test\TestCase;

final class LoggerTest
    extends TestCase
{
    /**
     *
     */
    function test_message()
    {
        $logger = new Logger;

        $this->assertEquals('foo', $logger(fn() => 'foo'));
        $this->assertEquals('foo', $logger(fn($message) => $message));
    }

    /**
     *
     */
    function test_throw_exception_false()
    {
        $logger = new Logger;

        $this->assertFalse($logger(fn($throw_exception = false) => $throw_exception));
    }

    /**
     *
     */
    function test_throw_exception_true()
    {
        $logger = new Logger(true);

        $this->assertTrue($logger(fn($throw_exception) => $throw_exception));
    }
}
