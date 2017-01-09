<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Model;
use Mvc5\Layout;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Hydrator;
use Mvc5\Plugin\Invokable;
use Mvc5\Plugin\Plug;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;
use Mvc5\View\Layout as ViewLayout;

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
     *
     */
    function test_call_method_on_current_object_with_single_argument()
    {
        $plugin = new Hydrator(Model::class, ['template' => 'foo']);

        $model = (new App)->plugin($plugin);

        $this->assertInstanceOf(Model::class, $model);
        $this->assertEquals('foo', $model->template());
    }

    /**
     *
     */
    function test_call_method_on_current_object_with_multiple_args()
    {
        $plugin = new Hydrator(Model::class, ['vars' => ['foo' => 'bar'], 'template' => 'baz']);

        $model = (new App)->plugin($plugin);

        $this->assertInstanceOf(Model::class, $model);
        $this->assertEquals('bar', $model->get('foo'));
        $this->assertEquals('baz', $model->template());
    }

    /**
     *
     */
    function test_call_same_method_on_current_object_with_multiple_args()
    {
        $plugin = new Hydrator(Model::class, [['set', 'foo', 'bar'], ['set', 'bat', 'baz'], 'template' => 'foobar']);

        $model = (new App)->plugin($plugin);

        $this->assertInstanceOf(Model::class, $model);
        $this->assertEquals('bar', $model->get('foo'));
        $this->assertEquals('baz', $model->get('bat'));
        $this->assertEquals('foobar', $model->template());
    }

    /**
     * [$service, $method]
     */
    function test_call_service_method_and_pass_current_object_as_named_arg()
    {
        $plugin = new Hydrator(
            Layout::class, [['$layout', [new Plugin(ViewLayout::class), '__invoke'], 'model' => new Plugin(Model::class)]]
        );

        $layout = (new App)->plugin($plugin);

        $this->assertInstanceOf(Layout::class, $layout);
        $this->assertInstanceOf(Model::class, $layout->model());
    }

    /**
     *
     */
    function test_call_plugin_and_pass_current_object_as_named_arg()
    {
        $plugin = new Hydrator(
            Layout::class, [['$layout', new Plugin(ViewLayout::class), 'model' => new Plugin(Model::class)]]
        );

        $layout = (new App)->plugin($plugin);

        $this->assertInstanceOf(Layout::class, $layout);
        $this->assertInstanceOf(Model::class, $layout->model());
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
                'template' => new Invokable(function(Model $model, $template) {
                    $model->template($template);

                    return $model;
                })
            ]
        ]);

        $plugin = new Hydrator(Model::class, [['$model', new Plugin('template'), 'template' => new Plug('foo')]]);

        $model = $app->plugin($plugin);

        $this->assertInstanceOf(Model::class, $model);
        $this->assertEquals('bar', $model->template());
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

        $plugin = new Hydrator(Model::class, [new Plugin('callback')]);

        $this->assertInstanceOf(Model::class, $app->plugin($plugin));
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
