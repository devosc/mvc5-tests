<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Container;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_plugin_false()
    {
        $resolver = new Resolver;

        $this->assertFalse($resolver->plugin(false));
    }

    /**
     *
     */
    function test_plugin_string_build()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', new Container(['bar' => Config::class]));

        $this->assertEquals(new Config, $resolver->plugin('foo->bar'));
    }

    /**
     *
     */
    function test_plugin_array_without_named_args()
    {
        $resolver = new Resolver;

        $resolver->configure('exception\model', ['layout', 'exception']);
        $resolver->configure('layout',          ['Mvc5\Layout', 'layout']);

        $model = $resolver->plugin('exception\model');

        $this->assertEquals('exception', $model->template());
    }

    /**
     *
     */
    function test_plugin_array_with_named_args()
    {
        $resolver = new Resolver;

        $resolver->configure('exception\model', ['layout', 'template' => 'exception']);
        $resolver->configure('layout',          ['Mvc5\Layout', 'template' => 'layout']);

        $model = $resolver->plugin('exception\model');

        $this->assertEquals('exception', $model->template());
    }

    /**
     *
     */
    function test_plugin_with_recursive_service_array_config()
    {
        $resolver = new Resolver;

        $resolver->configure('stdClass', ['stdClass']);

        $this->assertEquals(new \stdClass, $resolver->plugin('stdClass'));
    }

    /**
     *
     */
    function test_plugin_closure_with_scope()
    {
        $resolver = new Resolver;

        $config = new Config;

        $resolver->scope($config);

        $this->assertEquals($config, $resolver->plugin(function() { return $this; }));
    }

    /**
     *
     */
    function test_plugin_closure_without_scope()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->plugin(function() { return 'foo'; }));
    }

    /**
     *
     */
    function test_plugin_resolvable()
    {
        $resolver = new Resolver;

        $this->assertEquals(new Config, $resolver->plugin(new Plugin(Config::class)));
    }
}
