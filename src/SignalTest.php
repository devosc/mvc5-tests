<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Plugin\Gem\SignalArgs;
use Mvc5\Service\Service;
use Mvc5\Session\Config as Session;
use Mvc5\ViewModel;
use Mvc5\Test\Test\TestCase;

class SignalTest
    extends TestCase
{
    /**
     *
     */
    function test_args()
    {
        $this->assertEquals(['foo' => 'bar'], (new App)->call(function($args) { return $args; }, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_null_param()
    {
        $this->assertEquals('bar', (new App)->call(function($foo) { return !$foo ? 'bar' : $foo; }, ['foo' => null]));
    }

    /**
     *
     */
    function test_callback_missing_param()
    {
        $this->assertEquals('bar', (new App)->call(function($foo) { return $foo; }, [], function($name) {
            return 'foo' == $name ? 'bar' : null;
        }));
    }

    /**
     * @runInSeparateProcess
     */
    function test_callback_missing_class_param()
    {
        $method = '@Mvc5\Service\Context::bind';

        $this->assertInstanceOf(App::class, (new App)->call($method, ['foo' => 'bar'], function($name) {
            return Service::class == $name ? new App : null;
        }));
    }

    /**
     *
     */
    function test_default_param()
    {
        $this->assertNull((new App)->call([new ViewModel, 'template']));
    }

    /**
     *
     */
    function test_empty_args()
    {
        $this->assertEquals([], (new App)->call(function() { return func_get_args(); }));
    }

    /**
     *
     */
    function test_named_arg()
    {
        $this->assertEquals('bar', (new App)->call(function($foo) { return $foo; }, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_no_param_function()
    {
        $this->expectExceptionMessage('Missing required parameter $haystack for strpos');

        (new App)->call('@strpos');
    }

    /**
     *
     */
    function test_no_param_exception_class_method()
    {
        $this->expectExceptionMessage('Missing required parameter $name for Mvc5\Session\Config::remove');

        (new App)->call([new Session, 'remove'], ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_no_param_exception_invoke()
    {
        $this->expectExceptionMessage('Missing required parameter $name for Mvc5\App::__invoke');

        (new App)->call(new App, ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_no_param_exception_static_method()
    {
        $method = 'Mvc5\Service\Builder::create';

        $this->expectExceptionMessage('Missing required parameter $name for ' . $method);

        (new App)->call('@' . $method, ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_numeric_args()
    {
        $this->assertEquals('foo', (new App)->call(function($foo) { return $foo; }, ['foo']));
    }

    /**
     *
     */
    function test_optional_arg()
    {
        $this->assertNull((new App)->call(function($foo = null) { return $foo; }));
    }

    /**
     *
     */
    function test_php_function()
    {
        $this->assertEmpty((new App)->call('@session_id'));
    }

    /**
     *
     */
    function test_static_string()
    {
        $this->assertInstanceOf(
            \ReflectionClass::class, (new App)->call('@Mvc5\Service\Builder::reflectionClass', ['name' => self::class])
        );
    }

    /**
     *
     */
    function test_variadic_args()
    {
        $function = function(...$args) {
            return $args[0] instanceof SignalArgs ? $args[0]->args() : null;
        };

        $this->assertEquals(['foo' => 'bar'], (new App)->call($function, ['foo' => 'bar']));
    }
}
