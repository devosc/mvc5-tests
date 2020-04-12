<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Container;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

final class CompositeTest
    extends TestCase
{
    /**
     *
     */
    function test_composite_app()
    {
        $app = new App([
            'services' => [
                'foo' => new App([
                    'services' => [
                        'bar' => new Plugin('bat'),
                        'bat' => Config::class
                    ]
                ])
            ]
        ]);

        $this->assertInstanceOf(Config::class, $app->plugin('foo->bar'));
    }

    /**
     *
     */
    function test_composite_array()
    {
        $app = new App([
            'services' => [
                'foo' => fn() => ['bar' => new Value('baz')]
            ]
        ]);

        $this->assertEquals('baz', $app->plugin('foo->bar'));
    }

    /**
     *
     */
    function test_composite_container()
    {
        $app = new App([
            'services' => [
                'foo' => new Container([
                    'bar' => new Value('baz')
                ])
            ]
        ]);

        $this->assertEquals('baz', $app->plugin('foo->bar'));
    }

    /**
     *
     */
    function test_composite_plugin()
    {
        $app = new App([
            'services' => [
                'foo' => new App([
                    'services' => [
                        'bar' => new Plugin('bat'),
                        'bat' => Config::class
                    ]
                ])
            ]
        ]);

        $this->assertInstanceOf(Config::class, $app->plugin(new Plugin('foo->bar')));
    }
}
