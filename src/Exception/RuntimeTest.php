<?php
/**
 *
 */

namespace Mvc5\Test\Exception;

use Mvc5\Exception\Runtime;
use Mvc5\Test\Test\TestCase;

class RuntimeTest
    extends TestCase
{
    /**
     *
     */
    function test_invalid_argument()
    {
        $exception = new Runtime('foo', 0, null, ['file' => 'bar.php', 'line' => 99]);

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals('bar.php', $exception->getFile());
        $this->assertEquals(99, $exception->getLine());
    }
}
