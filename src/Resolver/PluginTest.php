<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Container;
use Mvc5\ViewLayout;
use Mvc5\Plugin\Plug;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_closure_with_scope()
    {
        $config = new Config;

        $app = new App(null, null, $config);

        $this->assertEquals($config, $app->plugin(function() { return $this; }));
    }

    /**
     *
     */
    function test_closure_without_scope()
    {
        $this->assertEquals('foo', (new App)->plugin(function() { return 'foo'; }));
    }

    /**
     *
     */
    function test_composite()
    {
        $app = new App(['services' => ['foo' => new Container(['bar' => Config::class])]]);

        $this->assertEquals(new Config, $app->plugin('foo->bar'));
    }

    /**
     *
     */
    function test_custom_plugin()
    {
        $app = new App([
            'services' => [
                'service\resolver' => function() {
                    return function() {
                        return 'bar';
                    };
                }
            ]
        ]);

        $this->assertEquals('bar', $app->plugin(new CustomPlugin('foo')));
    }

    /**
     *
     */
    function test_false()
    {
        $this->assertFalse((new App)->plugin(false));
    }

    /**
     *
     */
    function test_invoke()
    {
        $app = new App;

        $this->assertEquals(new Config, $app(Config::class));
    }

    /**
     *
     */
    function test_invoke_with_provider()
    {
        $app = new App(null, function() { return 'bar'; });

        $this->assertEquals('bar', $app('foo'));
    }

    /**
     *
     */
    function test_invoke_without_provider()
    {
        $app = new App;

        $this->assertNull($app('foo'));
    }

    /**
     *
     */
    function test_recursive()
    {
        $app = new App([
            'services' => [
                'foo' => new Plugin(Config::class)
            ]
        ]);

        $this->assertInstanceOf(Config::class, $app->plugin(new Plug('foo')));
    }

    /**
     *
     */
    function test_resolvable()
    {
        $this->assertEquals(new Config, (new App)->plugin(new Plugin(Config::class)));
    }

    /**
     *
     */
    function test_service_array_recursive()
    {
        $app = new App([
            'services' => [
                'stdClass' => ['stdClass']
            ]
        ]);

        $this->assertEquals(new \stdClass, $app->plugin('stdClass'));
    }

    /**
     *
     */
    function test_service_array_with_named_args()
    {
        $app = new App([
            'services' => [
                'exception\model' => ['layout', 'template' => 'exception'],
                'layout' => [ViewLayout::class, 'template' => 'layout']
            ]
        ]);

        $model = $app->plugin('exception\model');

        $this->assertEquals('exception', $model->template());
    }

    /**
     *
     */
    function test_service_array_without_named_args()
    {
        $app = new App([
            'services' => [
                'exception\model' => ['layout', 'exception'],
                'layout' => [ViewLayout::class, 'layout']
            ]
        ]);

        $model = $app->plugin('exception\model');

        $this->assertEquals('exception', $model->template());
    }
}
