<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Config;
use Mvc5\App;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Scope;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ProviderTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $plugin = new Scope('foo', new Args(['bar']), 'baz');

        $this->assertTrue(is_callable($plugin->config()));

        $args = [new Link, new Plugin(App::class, [new Args(['bar']), new Link]), 'foo', new Args(['baz'])];

        $this->assertEquals($args, $plugin->args());
    }

    /**
     *
     */
    function test_scope()
    {
        /** @var App $plugins */

        $provider = new Scope(Config::class, []);

        $resolver = new Resolver;

        list($service, $plugins, $name) = $resolver->args($provider->args());

        $plugin = $provider->scope($service, $plugins, $name);

        $this->assertInstanceOf(Config::class, $plugin);

        $this->assertEquals($plugin, $plugins->scope());
    }

    /**
     *
     */
    function test_resolver_gem_with_class_name()
    {
        $resolver = new Resolver;

        $plugin = $resolver->gem(new Scope(Config::class, []));

        $this->assertInstanceOf(Config::class, $plugin);
    }

    /**
     *
     */
    function test_resolver_gem_with_plugin_name()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', Config::class);

        $plugin = $resolver->gem(new Scope('foo', []));

        $this->assertInstanceOf(Config::class, $plugin);
    }
}
