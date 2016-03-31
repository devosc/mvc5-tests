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
    public function test_plugin_array()
    {
        $resolver = new Resolver;

        $this->assertEquals(false, $resolver->plugin([false]));
    }

    /**
     *
     */
    public function test_plugin_closure()
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
