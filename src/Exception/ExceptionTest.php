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
     *
     */
    function test_error()
    {
        try {

            Exception::typeError('foo');

        } catch(\Throwable $error) {}

        $this->assertEquals('foo', $error->getMessage());
        $this->assertEquals(__FILE__, $error->getFile());
        $this->assertEquals(38, $error->getLine());
        $this->assertInstanceOf(\TypeError::class, $error);
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
        $this->assertEquals(55, $exception->getLine());
        $this->assertInstanceOf(\Exception::class, $exception);
    }

    /**
     *
     */
    function test_any_php_exception()
    {
        try {

            PHPException::logicException('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(72, $exception->getLine());
        $this->assertInstanceOf(\LogicException::class, $exception);
    }

    /**
     *
     */
    function test_php_error()
    {
        try {

            PHPException::typeError('foo');

        } catch(\Throwable $error) {}

        $this->assertEquals('foo', $error->getMessage());
        $this->assertEquals(__FILE__, $error->getFile());
        $this->assertEquals(89, $error->getLine());
        $this->assertInstanceOf(\TypeError::class, $error);
    }
}
