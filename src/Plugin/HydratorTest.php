<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Hydrator;
use Mvc5\Plugin\Invokable;
use Mvc5\Plugin\Plug;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;
use Mvc5\Template\Layout\Assign as AssignLayout;
use Mvc5\ViewLayout;
use Mvc5\ViewModel;

class HydratorTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $hydrator = new Hydrator('foo', []);

        $this->assertEquals('foo', $hydrator->name());
        $this->assertEquals([], $hydrator->args());
        $this->assertEquals('item', $hydrator->param());
    }

    /**
     * $this->resolve($method)
     */
    function test_call_function_with_args()
    {
        $result = null;

        $function = function($name) use(&$result) {
            if ('foo' == $name) {
                $result = 'foobar';
            }
        };

        $plugin = new Hydrator(Config::class, [[$function, 'foo']]);

        $this->assertInstanceOf(Config::class, (new App)->plugin($plugin));
        $this->assertEquals('foobar', $result);
    }

    /**
     * $this->resolve($method)
     */
    function test_call_function_with_args_and_current_object()
    {
        $app = new App([
            'services' => [
                'foo' => 'bar',
                'update\name' => new Invokable(function(Config $config, $name) {
                    $config['name'] = $name;
                    return $config;
                })
            ]
        ]);

        $plugin = new Hydrator(Config::class, [['$config', new Plugin('update\name'), 'name' => new Plug('foo')]]);

        $config = $app->plugin($plugin);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('bar', $config['name']);
    }

    /**
     *
     */
    function test_call_method_on_current_object_with_multiple_args()
    {
        $plugin = new Hydrator(Config::class, [['set', 'foo', 'bar'], ['set', 'bat', 'baz']]);

        $config = (new App)->plugin($plugin);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('bar', $config->get('foo'));
        $this->assertEquals('baz', $config->get('bat'));
    }

    /**
     *
     */
    function test_call_method_on_current_object_with_single_argument()
    {
        $plugin = new Hydrator(Config::class, ['set' => ['foo' => 'bar']]);

        $config = (new App)->plugin($plugin);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_call_plugin_and_pass_current_object_as_named_arg()
    {
        $plugin = new Hydrator(
            Config::class, [['$config', function(Config $config){ $config['foo'] = 'bar'; }]]
        );

        $config = (new App)->plugin($plugin);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('bar', $config->get('foo'));
    }

    /**
     *
     */
    function test_call_same_method_on_current_object_with_multiple_args()
    {
        $plugin = new Hydrator(Config::class, [['set', 'foo', 'bar'], ['set', 'bat', 'baz']]);

        $config = (new App)->plugin($plugin);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals('bar', $config->get('foo'));
        $this->assertEquals('baz', $config->get('bat'));
    }

    /**
     * [$service, $method]
     */
    function test_call_service_method_and_pass_current_object_as_named_arg()
    {
        $plugin = new Hydrator(
            ViewModel::class, [['$model', [new Plugin(AssignLayout::class, [new ViewLayout]), '__invoke']]]
        );

        $layout = (new App)->plugin($plugin);

        $this->assertInstanceOf(ViewModel::class, $layout);
    }

    /**
     *
     */
    function test_resolvable()
    {
        $called = false;

        $app = new App([
            'services' => [
                'callback' => new Call(function () use (&$called) {
                    $called = true;
                })
            ]
        ]);

        $plugin = new Hydrator(Config::class, [new Plugin('callback')]);

        $this->assertInstanceOf(Config::class, $app->plugin($plugin));
        $this->assertTrue($called);
    }

    /**
     *
     */
    function test_set_array_access()
    {
        $plugin = new Hydrator(Config::class, ['#foo' => 'bar']);

        $this->assertEquals(new Config(['foo' => 'bar']), (new App)->plugin($plugin));
    }

    /**
     *
     */
    function test_set_property()
    {
        $plugin = new Hydrator(Config::class, ['$foo' => 'bar']);

        $this->assertEquals(new Config(['foo' => 'bar']), (new App)->plugin($plugin));
    }
}
