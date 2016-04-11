<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Plugins;
use Mvc5\Plugin\Provide;
use Mvc5\Test\Test\TestCase;

class AppTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $config = [
            Arg::SERVICES => [
                Arg::CONTAINER => ['foo']
            ]
        ];

        $app = new App($config);

        $this->assertEquals($config, $app->config());
    }

    /**
     *
     */
    public function test_app_array_access_with_provider()
    {
        $app = new App([], function() { return 'bar'; });

        $this->assertEquals('bar', $app['foo']);
    }

    /**
     *
     */
    public function test_app_invoke_with_provider()
    {
        $app = new App([], function() { return 'bar'; });

        $this->assertEquals('bar', $app('foo'));
    }

    /**
     *
     */
    public function test_app_provider_and_scope()
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
                'foo' => new Plugins(
                    [
                        'home' => 9,
                        'var2' => new Plugin(Config::class, [new Args(['var3' => new Provide('var4')])]),
                        Config::class => function($args) {
                            return new Config($args);
                        },
                        'code' => 2,
                        'bar' => new Plugins(
                            [
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
                            ],
                            new Link,
                            true
                        )
                    ],
                    new Link
                )
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
}
