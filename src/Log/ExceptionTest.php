<?php
/**
 *
 */

namespace Mvc5\Test\Log;

use Mvc5\Log\Exception as ThrowException;
use Mvc5\Test\Test\TestCase;

class ExceptionTest
    extends TestCase
{
    /**
     *
     */
    function test_throw_exception()
    {
        $handler = new ThrowException;

        $this->setExpectedException(\Exception::class, 'Hello!');

        $handler(new \Exception('Hello!'), 'foobar', true);
    }

    /**
     *
     */
    function test_throw_exception_message()
    {
        $handler = new ThrowException;

        $this->setExpectedException(\Exception::class, 'Hello!');

        $handler(null, new \Exception('Hello!'), true);
    }

    /**
     *
     */
    function test_no_exception_thrown()
    {
        $handler = new ThrowException;

        $this->assertInstanceOf(\Exception::class, $handler(new \Exception('Hello!')));
    }

    /**
     *
     */
    function test_no_exception_thrown_message()
    {
        $handler = new ThrowException;

        $this->assertInstanceOf(\Exception::class, $handler(null, new \Exception('Hello!')));
    }

    /**
     *
     */
    function test_no_exception_thrown_with_message()
    {
        $handler = new ThrowException;

        $this->assertInstanceOf(\Exception::class, $handler(new \Exception('Hello!'), 'foo'));
    }

    /**
     *
     */
    function test_no_exception()
    {
        $handler = new ThrowException;

        $this->assertEquals('foo', $handler('foo', null, true));
    }

    /**
     *
     */
    function test_no_exception_with_message()
    {
        $handler = new ThrowException;

        $this->assertEquals('foo', $handler(null, 'foo', true));
    }

    /**
     *
     */
    function test_return_message()
    {
        $handler = new ThrowException;

        $this->assertEquals('foo', $handler(null, 'foo'));
    }
}
