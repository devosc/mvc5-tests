<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Config;
use Mvc5\Plugins;
use Mvc5\Plugin\Provider;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ProviderTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Provider::class, new Provider('foo'));
    }

    /**
     *
     */
    public function test_provider()
    {
        /** @var Plugins $plugins */

        $provider = new Provider(Config::class, []);

        $resolver = new Resolver;

        list($service, $plugins, $name) = $resolver->args($provider->args());

        $plugin = $provider->provider($service, $plugins, $name);

        $this->assertInstanceOf(Config::class, $plugin);

        $this->assertEquals($plugin, $plugins->scope());
    }

    /**
     *
     */
    public function test_resolver_gem_with_class_name()
    {
        $resolver = new Resolver;

        $plugin = $resolver->gem(new Provider(Config::class, []));

        $this->assertInstanceOf(Config::class, $plugin);
    }

    /**
     *
     */
    public function test_resolver_gem_with_plugin_name()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', Config::class);

        $plugin = $resolver->gem(new Provider('foo', []));

        $this->assertInstanceOf(Config::class, $plugin);
    }
}
