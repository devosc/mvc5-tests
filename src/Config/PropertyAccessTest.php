<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class PropertyAccessTest
    extends TestCase
{
    /**
     *
     */
    function test_isset()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertTrue(isset($config->foo));
    }

    /**
     *
     */
    function test_get()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('bar', $config->foo);
    }

    /**
     *
     */
    function test_set()
    {
        $config = new Config;

        $this->assertEquals('bar', $config->foo = 'bar');
    }

    /**
     *
     */
    function test_unset()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertTrue(isset($config->foo));

        unset($config->foo);

        $this->assertFalse(isset($config->foo));
    }
}
