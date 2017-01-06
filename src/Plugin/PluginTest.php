<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_defaults()
    {
        $plugin = new Plugin('foo');

        $this->assertEquals('foo', $plugin->name());
        $this->assertEquals([], $plugin->args());
        $this->assertEquals([], $plugin->calls());
        $this->assertEquals('item', $plugin->param());
        $this->assertFalse($plugin->merge());
    }

    /**
     *
     */
    function test_param_false()
    {
        $plugin = new Plugin('foo', [], [], null);

        $this->assertEquals('item', $plugin->param());
    }

    /**
     *
     */
    function test_plugin()
    {
        $plugin = new Plugin(Config::class, [['foo' => 'bar']]);

        $this->assertEquals(new Config(['foo' => 'bar']), (new App)->plugin($plugin));
    }
}
