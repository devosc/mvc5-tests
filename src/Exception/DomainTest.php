<?php
/**
 *
 */

namespace Mvc5\Test\Exception;

use Mvc5\Exception;
use Mvc5\Exception\DomainException;
use Mvc5\Test\Test\TestCase;

class DomainTest
    extends TestCase
{
    /**
     *
     */
    function test_domain_exception()
    {
        try {

            Exception::domain('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(22, $exception->getLine());
        $this->assertInstanceOf(DomainException::class, $exception);
    }

    /**
     *
     */
    function test_php_domain_exception()
    {
        try {

            PHPException::domain('foo');

        } catch(\Exception $exception) {}

        $this->assertEquals('foo', $exception->getMessage());
        $this->assertEquals(__FILE__, $exception->getFile());
        $this->assertEquals(39, $exception->getLine());
        $this->assertInstanceOf(\DomainException::class, $exception);
    }
}
