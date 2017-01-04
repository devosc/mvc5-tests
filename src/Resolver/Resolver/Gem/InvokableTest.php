<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\App;
use Mvc5\Plugin\Call;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Invokable;
use Mvc5\Test\Test\TestCase;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    function test_merge()
    {
        $app = new App;

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })), ['s']
        );

        $callable = $app->plugin($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $app->call($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_named()
    {
        $app = new App;

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })), ['baz' => 's']
        );

        $callable = $app->plugin($invokable);

        $this->assertEquals('foobars', $app->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    function test_not_named()
    {
        $app = new App;

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })), ['s']
        );

        $callable = $app->plugin($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $app->call($callable, ['foo', 'bar']));
    }
}
