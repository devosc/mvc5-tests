<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Test\Test\TestCase;

class BuildTest
    extends TestCase
{
    /**
     *
     */
    function test_not_unique_array_with_same_service_name()
    {
        $app = new App([
            'services' => [
                Config::class => [Config::class]
            ]
        ]);

        $this->assertInstanceOf(Config::class, $app->plugin(Config::class));
    }

    /**
     *
     */
    function test_not_unique_with_config()
    {
        $app = new App([
            'services' => [
                'foo' => Config::class
            ]
        ]);

        $this->assertInstanceOf(Config::class, $app->plugin('foo'));
    }

    /**
     *
     */
    function test_strict_with_config()
    {
        $config = [
            'services' => [
                Config::class => Config::class,
                'foo' => Config::class
            ]
        ];

        $app = new App($config, null, null, true);

        $this->assertInstanceOf(Config::class, $app->plugin('foo'));
    }

    /**
     *
     */
    function test_unique_not_strict_without_config()
    {
        $app = new App;

        $this->assertInstanceOf(Config::class, $app->plugin(Config::class));
    }

    /**
     *
     */
    function test_unique_with_config()
    {
        $app = new App([
            'services' => [
                Config::class => Config::class
            ]
        ]);

        $this->assertInstanceOf(Config::class, $app->plugin(Config::class));
    }

    /**
     *
     */
    function test_with_callback()
    {
        $app = new App;

        $this->assertInstanceOf(Config::class, $app->plugin('foo', [], function($name) {
            return 'foo' == $name ? new Config : null;
        }));
    }
}
