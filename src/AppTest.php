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
                'var4' => function() { return '6'; },
                'code' => 1,
                'foo' => new Plugins(
                    [
                        'home' => 9,
                        //'var3' => function() { return '4'; },
                        //'var2' => [Config::class, new Args(['var3' => new Plugin('var3')])],
                        'var2' => new Plugin(Config::class, [new Args(['var3' => new Provide('var4')])]), //Parent provider
                        Config::class => function($args) {
                            return new Config($args);
                        },
                        'code' => 2,
                        'bar' => new Plugins(
                            [
                                'code' => 5,
                                'test' => function($bat, $code, $home, $var2, Config $config) {
                                    return function($param) use($bat, $code, $home, $var2) {
                                        return $bat . $code . $home . $param . $var2['var3'];
                                    };
                                },
                                'baz' => function() {
                                    return function() {
                                        /** @var \Mvc5\Service\Plugin $this */

                                        return $this->call('test', ['param' => '3']);
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

        $this->assertEquals('foobar5936', $app->call('foo->bar->baz'));
    }
}
