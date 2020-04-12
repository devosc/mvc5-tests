<?php
/**
 *
 */

namespace Mvc5\Test\Exception;

use Mvc5\Exception;
use Mvc5\Exception\InvalidArgumentException;
use Mvc5\Test\Test\TestCase;

final class InvalidArgumentTest
    extends TestCase
{
    /**
     *
     */
    function test_invalid_argument_exception()
    {
        try {

            Exception::invalidArgument('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(22, $exception->getLine());
        $this->assertInstanceOf(InvalidArgumentException::class, $exception);
    }

    /**
     *
     */
    function test_php_invalid_argument_exception()
    {
        try {

            PHPException::invalidArgument('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(39, $exception->getLine());
        $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
    }
}
