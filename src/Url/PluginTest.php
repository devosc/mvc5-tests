<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Route\Definition;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Plugin::class, new Plugin(new Route, function(){}));
    }

    /**
     *
     */
    public function test_generator()
    {
        $generator = function(){};
        $plugin    = new Plugin(new Route, $generator);

        $this->assertEquals($generator, $plugin->generator());
    }

    /**
     *
     */
    public function test_url()
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
    public function test_invoke()
    {
        $plugin = new Plugin(new Route, function() { return 'foo'; });

        $this->assertEquals('foo', $plugin());
    }
}
