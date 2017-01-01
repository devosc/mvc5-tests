<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Config;
use Mvc5\App;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Link;
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
        $scope = new Scope('foo', ['bar', 'baz']);

        $args = ['foo', new Link, new Args(['bar', 'baz'])];

        $this->assertTrue(is_callable($scope->config()));
        $this->assertEquals($args, $scope->args());
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

        $scope = $provider->scope($name, $service, $args);

        $this->assertInstanceOf(Config::class, $scope);

        $this->assertEquals($scope, $app->scope());
    }

    /**
     *
     */
    function test_resolver_gem_with_class_name()
    {
        $resolver = new Resolver;

        $scope = $resolver->gem(new Scope(Config::class, [new App]));

        $this->assertInstanceOf(Config::class, $scope);
    }

    /**
     *
     */
    function test_resolver_gem_with_plugin_name()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', Config::class);

        $scope = $resolver->gem(new Scope('foo', [new App]));

        $this->assertInstanceOf(Config::class, $scope);
    }
}
