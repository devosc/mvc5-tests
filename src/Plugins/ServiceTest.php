<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\ArrayModel;
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

        $this->assertEquals(new ArrayModel($config), $service->plugin('config'));
    }

    /**
     *
     */
    function test_shared()
    {
        $container = ['foo' => 'bar',  'baz' => 'bat'];

        $service = new ServicePlugin(new App(['container' => $container]));

        $this->assertEquals('bar', $service->shared('foo'));
        $this->assertEquals('bat', $service->shared('foobar', fn() => 'bat'));
        $this->assertEquals('bat', $service->shared('foobar'));
        $this->assertEquals($container, $service->shared(['foo', 'baz']));
    }

    /**
     *
     */
    function test_trigger()
    {
        $app = new App([
            'events' => [
                'foo' => [
                    fn($bar) => $bar
                ]
            ]
        ]);

        $service = new ServicePlugin($app);

        $this->assertEquals('bar', $service->trigger('foo', ['bar']));
    }
}
