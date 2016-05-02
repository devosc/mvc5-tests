<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Route\Definition;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Plugin::class, new Plugin(new Route, function(){}));
    }

    /**
     *
     */
    function test_generator()
    {
        $generator = function(){};
        $plugin    = new Plugin(new Route, $generator);

        $this->assertEquals($generator, $plugin->generator());
    }

    /**
     *
     */
    function test_name_not_null()
    {
        $plugin = new Plugin(new Route, function(){});

        $this->assertEquals('foo', $plugin->name('foo'));
    }

    /**
     *
     */
    function test_name_null_use_route()
    {
        $plugin = new Plugin(new Route([Arg::NAME => 'foo']), function(){});

        $this->assertEquals('foo', $plugin->name(null));
    }

    /**
     *
     */
    function test_options()
    {
        $options = [
            Arg::SCHEME   => 'scheme',
            Arg::HOSTNAME => 'localhost',
            Arg::PORT     => 'port',
        ];

        $plugin = new Plugin(new Route($options), function(){});

        $this->assertEquals($options, $plugin->options());
    }

    /**
     *
     */
    function test_params_with_name()
    {
        $plugin = new Plugin(new Route, function(){});

        $this->assertEquals(['foo' => 'bar'], $plugin->params('foo', ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_params_with_no_name_and_from_route()
    {
        $params = ['foo' => 'bar'];

        $plugin = new Plugin(new Route([Arg::PARAMS => $params]), function(){});

        $this->assertEquals(['baz' => 'bat'] + $params, $plugin->params(null, ['baz' => 'bat']));
    }

    /**
     *
     */
    function test_url()
    {
        $generator = function($name, array $args = []) {
            return $name . '/' . key($args) . '/' . current($args);
        };

        $plugin = new Plugin(new Route, $generator);

        $this->assertEquals('foo/bar/baz', $plugin->url('foo', ['bar' => 'baz']));
    }

    /**
     *
     */
    function test_invoke()
    {
        $plugin = new Plugin(new Route, function() { return 'foo'; });

        $this->assertEquals('foo', $plugin());
    }
}
