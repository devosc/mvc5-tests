<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Config;
use Mvc5\App;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Scope;
use Mvc5\Test\Test\TestCase;

class ScopeTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $scope = new Scope([], Config::class);

        $args = [new Plugin(App::class, [['services' => []], null, true, true]), new Link, Config::class];

        $this->assertTrue(is_callable($scope->config()));
        $this->assertEquals($args, $scope->args());
    }

    /**
     * @throws \Throwable
     */
    function test_scope()
    {
        $plugins = [
            'bar' => fn() => 'foobar',
            'foo' => fn() => $this->get('bar'),
            'scope' => fn() => $this
        ];

        $config = (new App)(new Scope($plugins, Config::class));

        $this->assertInstanceOf(Config::class, $config);
        $this->assertInstanceOf(Config::class, $config['scope']);
        $this->assertEquals('foobar', $config['foo']);
    }
}
