<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Plugin\Config;
use Mvc5\Test\Test\TestCase;

class ServiceTest
    extends TestCase
{
    /**
     *
     */
    function test_call()
    {
        $service = new ServicePlugin(new App);

        $this->assertEquals(phpversion(), $service->call('@phpversion'));
    }

    /**
     *
     */
    function test_param()
    {
        $params = ['foo' => ['bar' => 'baz'],  'bar' => 'baz'];

        $service = new ServicePlugin(new App($params));

        $this->assertEquals('baz', $service->param('foo.bar'));
        $this->assertEquals(['bar' => 'baz'], $service->param('foo'));
        $this->assertEquals($params + ['foobar' => null], $service->param(['foo', 'bar', 'foobar']));
    }

    /**
     *
     */
    function test_plugin()
    {
        $config = [
            'services' => [
                'config' => new Config
            ]
        ];

        $app = new App($config);

        $service = new ServicePlugin($app);

        $this->assertEquals($config, $service->plugin('config'));
    }

    /**
     *
     */
    function test_shared()
    {
        $service = new ServicePlugin(new App);

        $provider = function() {
            return 'foo';
        };

        $this->assertEquals('foo', $service->shared('foo', $provider));
        $this->assertEquals('foo', $service->shared('foo'));
    }

    /**
     *
     */
    function test_trigger()
    {
        $app = new App([
            'events' => [
                'foo' => [
                    function($bar) {
                        return $bar;
                    }
                ]
            ]
        ]);

        $service = new ServicePlugin($app);

        $this->assertEquals('bar', $service->trigger('foo', ['bar']));
    }
}
