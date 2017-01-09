<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Exception;
use Mvc5\Exception\InvalidArgument;
use Mvc5\Exception\Runtime;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test_exception()
    {
        $this->setExpectedException(Exception::class, 'foo');
        Exception::exception('foo');
    }

    /**
     *
     */
    function test_invalid_argument()
    {
        $this->setExpectedException(InvalidArgument::class, 'foo');
        Exception::invalidArgument('foo');
    }

    /**
     *
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
    function test_raise()
    {
        $this->setExpectedException(\Exception::class, 'foo');
        Exception::raise(new \Exception('foo'));
    }

    /**
     *
     */
    function test_runtime()
    {
        $this->setExpectedException(Runtime::class, 'foo');
        Exception::runtime('foo');
    }
}
