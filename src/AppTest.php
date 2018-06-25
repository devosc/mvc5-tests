<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Callback;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Plugins;
use Mvc5\Plugin\Provide;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

class AppTest
    extends TestCase
{
    /**
     *
     */
    function test_array_access_with_provider()
    {
        $app = new App([], function($name) { return 'foo' == $name ? 'bar' : null; });

        $this->assertEquals('bar', $app['foo']);
    }

    /**
     *
     */
    function test_config()
    {
        $config = [
            Arg::SERVICES => [
                'foo' => ['foobar']
            ]
        ];

        $app = new App($config);

        $this->assertEquals($config, $app->config());
    }

    /**
     *
     */
    function test_invoke_with_provider()
    {
        $app = new App([], function() { return 'bar'; });

        $this->assertEquals('bar', $app('foo'));
    }

    /**
     *
     */
    function test_not_strict()
    {
        $app = new App();

        $this->assertEquals(new \ArrayObject, $app['ArrayObject']);
    }

    /**
     *
     */
    function test_provider_and_scope()
    {
        $app = new App([
            Arg::SERVICES => [
                'var3' => function() { return 'foobar'; },
                'var2' => [Config::class, new Args(['var3' => new Plugin('var3')])],
                'bat' => function($var2) {
                    return $var2['var3'];
                },
                Config::class => Config::class,
                'v3' => function() { return '6'; },
                'v2' => [Config::class, new Args(['v3' => new Plugin('v3')])],
                'var4' => function($v2) { return $v2['v3']; },
                'code' => 1,
                'foo' => new Plugins([
                    'home' => 9,
                    'var2' => new Plugin(Config::class, [new Args(['var3' => new Provide('var4')])]),
                    Config::class => function($argv) {
                        return new Config($argv);
                    },
                    'code' => 2,
                    'bar' => new Plugins([
                        'code' => 5,
                        Config::class => new Provide(Config::class), //Provide from parent
                        'test' => function($bat, $code, $home, $var2, Config $config) {
                            return function($param, $param2, Config $config) use($bat, $code, $home, $var2) {
                                return $bat . $code . $home . $param . $var2['var3'] . $param2;
                            };
                        },
                        'baz' => function() {
                            return function($param2) {
                                /** @var \Mvc5\Service\Plugin $this */

                                return $this->call('test', ['param' => '3', 'param2' => $param2]);
                            };
                        }
                    ])
                ])
            ]
        ]);

        $this->assertEquals('foobar', $app['bat']);
        $this->assertEquals('foobar', $app('bat'));
        $this->assertEquals('foobar', $app->get('bat'));
        $this->assertEquals('foobar', $app->plugin('bat'));
        $this->assertEquals('6', $app['foo']['var2']['var3']);
        $this->assertEquals('foobar59360', $app->call($app['foo']['bar']['baz'], ['param2' => '0']));
        $this->assertEquals('foobar59360', $app->call('foo->bar->baz', ['param2' => '0']));
    }

    /**
     * @throws \Throwable
     */
    function test_scope()
    {
        $app = new App([
            'services' => [
                'bar' => function() {
                    return $this;
                },
                'foo' => new Plugin('bar')
            ]
        ], null, true);

        $this->assertEquals($app, $app->plugin('bar'));
        $this->assertEquals($this, $app->plugin('foo'));
    }

    /**
     * @throws \Throwable
     */
    function test_custom_scope()
    {
        $config = new Config;

        $app = new App([
            'services' => [
                'bar' => function() {
                    return $this;
                },
                'foo' => new Plugin('bar')
            ]
        ], null, $config);

        $this->assertEquals($config, $app->plugin('bar'));
        $this->assertEquals($this, $app->plugin('foo'));
    }

    /**
     * @throws \Throwable
     */
    function test_callable_closure_scope()
    {
        $app = new App([
            'services' => [
                'bar' => new Callback(function() {
                    return $this;
                }),
                'foo' => new Invoke(function() {
                    return $this;
                }),
            ]
        ], null, true);

        $this->assertEquals($app, $app->plugin('bar')());
        $this->assertEquals($this, $app->plugin('foo')());
    }

    /**
     * @throws \Throwable
     */
    function test_callable_closure_custom_scope()
    {
        $config = new Config;

        $app = new App([
            'services' => [
                'bar' => new Callback(function() {
                    return $this;
                }),
                'foo' => new Invoke(function() {
                    return $this;
                }),
            ]
        ], null, $config);

        $this->assertEquals($config, $app->plugin('bar')());
        $this->assertEquals($this, $app->plugin('foo')());
    }

    /**
     * @throws \Throwable
     */
    function test_callable_closure_without_scope()
    {
        $app = new App([
            'services' => [
                'bar' => new Callback(function() {
                    return $this;
                }),
                'foo' => new Invoke(function() {
                    return $this;
                }),
            ]
        ]);

        $this->assertEquals($this, $app->plugin('bar')());
        $this->assertEquals($this, $app->plugin('foo')());
    }

    /**
     *
     */
    function test_strict_with_no_config()
    {
        $app = new App([], null, null, true);

        $this->assertNull($app['ArrayObject']);
    }

    /**
     *
     */
    function test_strict_with_config()
    {
        $app = new App([Arg::SERVICES => ['ArrayObject' => 'ArrayObject']], null, null, true);

        $this->assertEquals(new \ArrayObject, $app['ArrayObject']);
    }

    /**
     *
     */
    function test_with_private_plugins()
    {
        $app = new App([
            'bat' => new Value('baz'),
            'services' => [
                'foo' => new Plugin(Config::class, [new Args(['foo' => new Param('bat')])])
            ]
        ]);

        $this->assertNull($app['bat']);
        $this->assertEquals(new Config(['foo' => 'baz']), $app['foo']);
    }

    /**
     *
     */
    function test_with_private_values()
    {
        $app = new App([
            'bat' => 'baz',
            'services' => [
                'foo' => new Plugin(Config::class, [new Args(['foo' => new Param('bat')])])
            ]
        ]);

        $this->assertNull($app['bat']);
        $this->assertEquals(new Config(['foo' => 'baz']), $app['foo']);
    }
}
