<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Service\Service;
use Mvc5\Signal;
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
        $this->assertEquals('bar', Signal::emit(function($args) { return $args; }, ['bar']));
    }

    /**
     *
     */
    function test_args_empty()
    {
        $this->assertEquals([], Signal::emit(function() { return func_get_args(); }));
    }

    /**
     *
     */
    function test_args_named()
    {
        $this->assertEquals('bar', Signal::emit(function($foo) { return $foo; }, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_args_optional()
    {
        $this->assertNull(Signal::emit(function($foo = null) { return $foo; }));
    }

    /**
     *
     */
    function test_args_variadic()
    {
        $function = function($foo, ...$args) {
            return array_merge([$foo], $args);
        };

        $this->assertEquals(['foo', 'bar'], Signal::emit($function, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_args_variadic_named()
    {
        $function = function($foo, ...$args) {
            return array_merge([$foo], $args);
        };

        $this->assertEquals(['bar', 'bat'], Signal::emit($function, ['foo' => 'bar', 'baz' => 'bat']));
    }

    /**
     *
     */
    function test_null_param()
    {
        $this->assertEquals('bar', Signal::emit(function($foo) { return !$foo ? 'bar' : $foo; }, ['foo' => null]));
    }

    /**
     *
     */
    function test_callback_missing_param()
    {
        $this->assertEquals('bar', Signal::emit(function($foo) { return $foo; }, [], function($name) {
            return 'foo' == $name ? 'bar' : null;
        }));
    }

    /**
     * @runInSeparateProcess
     */
    function test_callback_missing_class_param()
    {
        $method = 'Mvc5\Service\Context::bind';

        $this->assertInstanceOf(App::class, Signal::emit($method, ['foo' => 'bar'], function($name) {
            return Service::class == $name ? new App : null;
        }));
    }

    /**
     *
     */
    function test_default_param()
    {
        $this->assertNull(Signal::emit([new ViewModel, 'template']));
    }

    /**
     *
     */
    function test_no_param_function()
    {
        $this->expectExceptionMessage('Missing required parameter $haystack for strpos');

        Signal::emit('strpos');
    }

    /**
     *
     */
    function test_no_param_exception_class_method()
    {
        $this->expectExceptionMessage('Missing required parameter $name for Mvc5\Config::remove');

        Signal::emit([new Config, 'remove'], ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_no_param_exception_invoke()
    {
        $this->expectExceptionMessage('Missing required parameter $name for Mvc5\App::__invoke');

        Signal::emit(new App, ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_no_param_exception_static_method()
    {
        $method = 'Mvc5\Service\Builder::create';

        $this->expectExceptionMessage('Missing required parameter $name for ' . $method);

        Signal::emit($method, ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_php_function()
    {
        $this->assertEmpty(Signal::emit('session_id'));
    }

    /**
     *
     */
    function test_static_string()
    {
        $this->assertInstanceOf(
            \ReflectionClass::class, Signal::emit('Mvc5\Service\Builder::reflectionClass', ['name' => self::class])
        );
    }

    /**
     *
     */
    function test_argv()
    {
        $function = function($argv) {
            return $argv;
        };

        $this->assertEquals(['foo' => 'bar'], Signal::emit($function, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_with_argv()
    {
        $function = function($foo, $argv) {
            return ['foo' => $foo] + $argv;
        };

        $args = ['foo' => 'bar', 'baz' => 'bat'];

        $this->assertEquals($args, Signal::emit($function, $args));
    }

    /**
     *
     */
    function test_variadic_argv()
    {
        $function = function(...$argv) {
            return $argv[0]->args();
        };

        $this->assertEquals(['foo' => 'bar'], Signal::emit($function, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_with_variadic_argv()
    {
        $function = function($foo, ...$argv) {
            return ['foo' => $foo] + $argv[0]->args();
        };

        $args = ['foo' => 'bar', 'baz' => 'bat'];

        $this->assertEquals($args, Signal::emit($function, $args));
    }
}
