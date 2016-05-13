<?php
/**
 *
 */

namespace Mvc5\Test\Model\Config;

use Mvc5\Model\Config;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_get()
    {
        $config = new Config(['foo' => 'bar']);

        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_get_not_set()
    {
        $config = new Config;

        $this->assertEquals(null, $config->get('foo'));
    }

    /**
     *
     */
    function test_offset_get()
    {
        $config = new Config;

        $config['foo'] = ['bar' => 'baz'];

        $this->assertEquals('baz', $config['foo']['bar']);

        $config['foo']['bar'] = 'bat';

        $this->assertEquals('bat', $config['foo']['bar']);
    }

    /**
     *
     */
    function test_property_get()
    {
        $config = new Config;

        $config->foo = ['bar' => 'baz'];

        $this->assertEquals('baz', $config->foo['bar']);

        $config->foo['bar'] = 'bat';

        $this->assertEquals('bat', $config->foo['bar']);
    }
}
