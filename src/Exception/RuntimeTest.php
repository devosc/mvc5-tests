<?php
/**
 *
 */

namespace Mvc5\Test\Exception;

use Mvc5\Exception;
use Mvc5\Exception\Runtime;
use Mvc5\Test\Test\TestCase;

class RuntimeTest
    extends TestCase
{
    /**
     *
     */
    function test_runtime_exception()
    {
        try {

            Exception::runtime('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(22, $exception->getLine());
        $this->assertInstanceOf(Runtime::class, $exception);
    }

    /**
     *
     */
    function test_php_runtime_exception()
    {
        try {

            PHPException::runtime('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(39, $exception->getLine());
        $this->assertInstanceOf(\RuntimeException::class, $exception);
    }
}
