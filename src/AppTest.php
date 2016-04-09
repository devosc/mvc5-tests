<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Plugins;
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
                'bat' => function() {
                    return 'foobar';
                },
                'code' => 1,
                'foo' => new Plugins(
                    [
                        'code' => 2,
                        'bar' => new Plugins(
                            [
                                'home' => 9,
                                'code' => 5,
                                'test' => function() {
                                    return function($bat, $code, $home) {
                                        return $bat . $code . $home;
                                    };
                                },
                                'baz' => function() {
                                    return function() {
                                        /** @var \Mvc5\Service\Plugin $this */

                                        return $this->call('test');
                                    };
                                }
                            ],
                            new Link, //$bat
                            true
                        )
                    ],
                    new Link //$bat
                )
            ]
        ]);

        $this->assertEquals('foobar59', $app->call('foo->bar->baz'));
    }
}
