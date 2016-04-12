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
    public function test_plugin_false()
    {
        $resolver = new Resolver;

        $this->assertEquals(false, $resolver->plugin(false));
    }

    /**
     *
     */
    public function test_plugin_string_build()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', new Container(['bar' => Config::class]));

        $this->assertEquals(new Config, $resolver->plugin('foo->bar'));
    }

    /**
     *
     */
    public function test_plugin_array_without_named_args()
    {
        $resolver = new Resolver;

        $resolver->configure('exception\model', ['layout', 'error/exception']);
        $resolver->configure('layout',          ['Mvc5\Layout', 'layout']);

        $model = $resolver->plugin('exception\model');

        $this->assertEquals('error/exception', $model->template());
    }

    /**
     *
     */
    public function test_plugin_array_with_named_args()
    {
        $resolver = new Resolver;

        $resolver->configure('exception\model', ['layout', 'template' => 'error/exception']);
        $resolver->configure('layout',          ['Mvc5\Layout', 'template' => 'layout']);

        $model = $resolver->plugin('exception\model');

        $this->assertEquals('error/exception', $model->template());
    }

    /**
     *
     */
    public function test_plugin_closure_with_scope()
    {
        $resolver = new Resolver;

        $config = new Config;

        $resolver->scope($config);

        $this->assertEquals($config, $resolver->plugin(function() { return $this; }));
    }

    /**
     *
     */
    public function test_plugin_closure_without_scope()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->plugin(function() { return 'foo'; }));
    }

    /**
     *
     */
    public function test_plugin_resolvable()
    {
        $resolver = new Resolver;

        $this->assertEquals(new Config, $resolver->plugin(new Plugin(Config::class)));
    }
}
