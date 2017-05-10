<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Log\ErrorLog;
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
    function test_not_parent_type_plugin()
    {
        $plugin = new Plugin(Config::class, ['config' => ['foo' => 'bar']]);

        $app = new App([
            'services' => [
                Config::class => Config::class
            ]
        ]);

        $this->assertEquals(new Config(['foo' => 'baz']), $app->plugin($plugin, ['config' => ['foo' => 'baz']]));
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
        $plugin = new Plugin(Config::class);

        $this->assertEquals(new Config, (new App)->plugin($plugin));
    }

    /**
     *
     */
    function test_provide_same_parent()
    {
        $plugin = new Plugin(Config::class);

        $app = new App([
            'services' => [
                Config::class => $plugin
            ]
        ]);

        $this->assertEquals(
            new Config(['foo' => 'bar']), $app->plugin($plugin, ['config' => ['foo' => 'bar']])
        );
    }

    /**
     *
     */
    function test_provide_with_merge()
    {
        $plugin = new Plugin('foo', ['message_type' => 'foo']);

        $app = new App([
            'services' => [
                'foo' => new Plugin(ErrorLog::class, ['message_type' => 'foobar', 'destination' => 'bar'])
            ]
        ]);

        $this->assertEquals(new ErrorLog('foo', 'bar', 'baz'), $app->plugin($plugin, ['extra_headers' => 'baz']));
    }

    /**
     *
     */
    function test_with_args()
    {
        $plugin = new Plugin(Config::class, [['foo', 'bar']]);

        $this->assertEquals(new Config(['foo', 'baz']), (new App)->plugin($plugin, [['foo', 'baz']]));
    }

    /**
     *
     */
    function test_with_named_args()
    {
        $plugin = new Plugin(Config::class, ['config' => ['foo' => 'bar']]);

        $this->assertEquals(new Config(['foo' => 'baz']), (new App)->plugin($plugin, ['config' => ['foo' => 'baz']]));
    }
}
