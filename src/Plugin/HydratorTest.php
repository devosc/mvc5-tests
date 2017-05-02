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
    function atest_call_method_on_current_object_with_multiple_args()
    {
        $plugin = new Hydrator(App::class, ['container' => ['foo' => 'bar'], 'template' => 'baz']);

        $model = (new App)->plugin($plugin);

        $this->assertInstanceOf(Config::class, $model);
        $this->assertEquals('bar', $model->get('foo'));
        $this->assertEquals('baz', $model->template());
    }

    /**
     *
     */
    function atest_call_method_on_current_object_with_single_argument()
    {
        $plugin = new Hydrator(ViewModel::class, ['template' => 'foo']);

        $model = (new App)->plugin($plugin);

        $this->assertInstanceOf(ViewModel::class, $model);
        $this->assertEquals('foo', $model->template());
    }

    /**
     *
     */
    function atest_call_plugin_and_pass_current_object_as_named_arg()
    {
        $plugin = new Hydrator(
            ViewLayout::class, [['$layout', new Plugin(AssignLayout::class), 'model' => new Plugin(ViewModel::class)]]
        );

        $layout = (new App)->plugin($plugin);

        $this->assertInstanceOf(ViewLayout::class, $layout);
        $this->assertInstanceOf(ViewModel::class, $layout->model());
    }

    /**
     *
     */
    function atest_call_same_method_on_current_object_with_multiple_args()
    {
        $plugin = new Hydrator(ViewModel::class, [['set', 'foo', 'bar'], ['set', 'bat', 'baz'], 'template' => 'foobar']);

        $model = (new App)->plugin($plugin);

        $this->assertInstanceOf(ViewModel::class, $model);
        $this->assertEquals('bar', $model->get('foo'));
        $this->assertEquals('baz', $model->get('bat'));
        $this->assertEquals('foobar', $model->template());
    }

    /**
     * [$service, $method]
     */
    function atest_call_service_method_and_pass_current_object_as_named_arg()
    {
        $plugin = new Hydrator(
            ViewLayout::class, [['$layout', [new Plugin(AssignLayout::class), '__invoke'], 'model' => new Plugin(ViewModel::class)]]
        );

        $layout = (new App)->plugin($plugin);

        $this->assertInstanceOf(ViewLayout::class, $layout);
        $this->assertInstanceOf(ViewModel::class, $layout->model());
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
