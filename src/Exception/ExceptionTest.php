<?php
/**
 *
 */

namespace Mvc5\Test\Exception;

use Mvc5\Exception;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test_exception()
    {
        try {

            Exception::exception('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(21, $exception->getLine());
        $this->assertInstanceOf(Exception::class, $exception);
    }

    /**
     * @deprecated
     */
    function test_invoke()
    {
        $exception = new Exception('foo');

        $this->setExpectedException(Exception::class, 'foo');

        $exception();
    }

    /**
     *
     */
    function test_php_exception()
    {
        try {

            PHPException::exception('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(50, $exception->getLine());
        $this->assertInstanceOf(\Exception::class, $exception);
    }
}
