<?php
/**
 *
 */

namespace Mvc5\Test\Config;

use Mvc5\Model\Config;
use Mvc5\Test\Test\TestCase;

class OverloadTest
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

        $this->assertNull($config->get('foo'));
    }

    /**
     *
     */
    function test_get_overload_array()
    {
        $config = new Config;

        $config['foo']['bar'] = 'baz';

        $this->assertEquals(['bar' => 'baz'], $config->get('foo'));
    }

    /**
     *
     */
    function test_get_overload_config()
    {
        $config = new Config(new Config);

        $config['foo']['bar'] = 'baz';

        $this->assertEquals(['bar' => 'baz'], $config->get('foo'));
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
    function test_offset_get_config_object()
    {
        $config = new Config(new Config(['foo' => ['bar' => 'baz']]));

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

    /**
     *
     */
    function test_property_get_config_object()
    {
        $config = new Config(new Config(['foo' => ['bar' => 'baz']]));

        $this->assertEquals('baz', $config->foo['bar']);

        $config->foo['bar'] = 'bat';

        $this->assertEquals('bat', $config->foo['bar']);
    }
}
