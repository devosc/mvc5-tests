<?php
/**
 *
 */

namespace Mvc5\Test\Exception;

use Mvc5\Exception;
use Mvc5\Exception\ErrorException;
use Mvc5\Test\Test\TestCase;

class ErrorExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test_error_exception()
    {
        try {

            Exception::errorException('foo', 0, E_ERROR, __FILE__, __LINE__);

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(22, $exception->getLine());
        $this->assertInstanceOf(\ErrorException::class, $exception);
    }

    /**
     *
     */
    function test_php_error_exception()
    {
        try {

            PHPException::errorException('foo', 0, E_ERROR, __FILE__, __LINE__);

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(39, $exception->getLine());
        $this->assertInstanceOf(\ErrorException::class, $exception);
    }

    /**
     *
     */
    function test_handler()
    {
        set_error_handler([ErrorException::class, 'handler']);

        try {

            strpos();

        } catch(\Exception $exception) {}

        restore_error_handler();

        $this->assertEquals('strpos() expects at least 2 parameters, 0 given', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(58, $exception->getLine());
        $this->assertInstanceOf(\ErrorException::class, $exception);
    }
}
