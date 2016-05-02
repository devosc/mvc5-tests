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
    function test_offsetExists()
    {
        $config = new PropertyConfig(['foo' => 'bar']);

        $this->assertTrue(isset($config->foo));
    }

    /**
     *
     */
    function test_offsetGet()
    {
        $config = new PropertyConfig(['foo' => 'bar']);

        $this->assertEquals('bar', $config->foo);
    }

    /**
     *
     */
    function test_offsetSet()
    {
        $config = new PropertyConfig;

        $this->assertEquals('bar', $config->foo = 'bar');
    }

    /**
     *
     */
    function test_offsetUnset()
    {
        $config = new PropertyConfig(['foo' => 'bar']);

        $this->assertTrue(isset($config->foo));

        unset($config->foo);

        $this->assertFalse(isset($config->foo));
    }
}
