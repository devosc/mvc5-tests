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
        $plugin = new Scope('foo', ['bar', 'baz']);

        $this->assertTrue(is_callable($plugin->config()));

        $args = ['foo', new Link, new Args(['bar', 'baz'])];

        $this->assertEquals($args, $plugin->args());
    }

    /**
     *
     */
    function test_scope()
    {
        $app = new App;

        $provider = new Scope(Config::class, [$app]);

        $resolver = new Resolver;

        list($name, $service, $args) = $resolver->args($provider->args());

        $plugin = $provider->scope($name, $service, $args);

        $this->assertInstanceOf(Config::class, $plugin);

        $this->assertEquals($plugin, $app->scope());
    }

    /**
     *
     */
    function test_resolver_gem_with_class_name()
    {
        $resolver = new Resolver;

        $plugin = $resolver->gem(new Scope(Config::class, [new App]));

        $this->assertInstanceOf(Config::class, $plugin);
    }

    /**
     *
     */
    function test_resolver_gem_with_plugin_name()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', Config::class);

        $plugin = $resolver->gem(new Scope('foo', [new App]));

        $this->assertInstanceOf(Config::class, $plugin);
    }
}
