<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class ArrayAccessTest
    extends TestCase
{
    /**
     *
     */
    public function test_offsetExists()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertTrue(isset($config['foo']));
    }

    /**
     *
     */
    public function test_offsetGet()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('bar', $config['foo']);
    }

    /**
     *
     */
    public function test_offsetSet()
    {
        $config = new Config;

        $this->assertEquals('bar', $config['foo'] = 'bar');
    }

    /**
     *
     */
    public function test_offsetUnset()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertTrue(isset($config['foo']));

        unset($config['foo']);

        $this->assertFalse(isset($config['foo']));
    }
}
