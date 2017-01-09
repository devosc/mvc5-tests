<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Call;
use Mvc5\Test\Test\TestCase;

class CallTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $call = new Call('foo', ['bar']);

        $this->assertEquals('foo', $call->config());
        $this->assertEquals(['bar'], $call->args());
    }

    /**
     *
     */
    function test_named()
    {
        $call = new Call(function($foo, $bar) { return $foo . $bar; });

        $this->assertEquals('foobar', (new App)->plugin($call, ['foo' => 'foo', 'bar' => 'bar']));
    }

    /**
     *
     */
    function test_named_with_parent_args()
    {
        $call = new Call(function($foo, $bar) { return $foo . $bar; }, ['bar' => 'bar']);

        $this->assertEquals('foobar', (new App)->plugin($call, ['foo' => 'foo']));
    }

    /**
     *
     */
    function test_no_args()
    {
        $call = new Call(function() { return 'foobar'; });

        $this->assertEquals('foobar', (new App)->plugin($call));
    }

    /**
     *
     */
    function test_not_named()
    {
        $call = new Call(function($foo, $bar) { return $foo . $bar; });

        $this->assertEquals('foobar', (new App)->plugin($call, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_not_named_with_parent_args()
    {
        $call = new Call(function($foo, $bar) { return $foo . $bar; }, ['bar']);

        $this->assertEquals('foobar', (new App)->plugin($call, ['foo']));
    }
}
