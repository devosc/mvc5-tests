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
use Mvc5\Test\Test\TestCase;

class ScopeTest
    extends TestCase
{
    /**
     *
     */
    function test()
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
        $app = new App([
            'services' => [
                'bar' => function() {
                    return 'foobar';
                },
                'foo' => function() {
                    /** @var Config $this */
                    return $this->get('bar');
                }
            ]
        ]);

        $plugin = new Scope(Config::class, [$app]);

        $config = (new App)->plugin($plugin);

        $this->assertInstanceOf(Config::class, $config);
        $this->assertEquals($config, $app->scope());
        $this->assertEquals('foobar', $config['foo']);
    }
}
