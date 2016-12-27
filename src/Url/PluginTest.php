<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Plugin::class, new Plugin(new Request, function(){}));
    }

    /**
     *
     */
    function test_generator()
    {
        $generator = function(){};
        $plugin    = new Plugin(new Request, $generator);

        $this->assertEquals($generator, $plugin->generator());
    }

    /**
     *
     */
    function test_name_not_null()
    {
        $plugin = new Plugin(new Request, function(){});

        $this->assertEquals('foo', $plugin->name('foo'));
    }

    /**
     *
     */
    function test_name_null_use_route()
    {
        $plugin = new Plugin(new Request([Arg::NAME => 'foo']), function(){});

        $this->assertEquals('foo', $plugin->name(null));
    }

    /**
     *
     */
    function test_options()
    {
        $options = [
            Arg::SCHEME => 'scheme',
            Arg::HOST   => 'localhost',
            Arg::PORT   => 'port',
        ];

        $plugin = new Plugin(new Request([Arg::URI => $options]), function(){});

        $this->assertEquals($options, $plugin->options());
    }

    /**
     *
     */
    function test_url()
    {
        $generator = function($name, array $params = []) {
            return $name . '/' . key($params) . '/' . current($params);
        };

        $plugin = new Plugin(new Request, $generator);

        $this->assertEquals('foo/bar/baz', $plugin->url('foo', ['bar' => 'baz']));
    }

    /**
     *
     */
    function test_current()
    {
        $generator = function($name, array $params = []) {
            return $name . '/' . key($params) . '/' . current($params);
        };

        $request = new Request([Arg::NAME => 'foo', Arg::PARAMS => ['bar' => 'baz']]);

        $plugin = new Plugin($request, $generator);

        $this->assertEquals('foo/bar/baz', $plugin());
    }
}
