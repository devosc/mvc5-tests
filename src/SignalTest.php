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

final class SignalTest
    extends TestCase
{
    /**
     *
     */
    function test_args()
    {
        $function = fn($args) => $args;

        $this->assertEquals('bar', Signal::emit($function, ['bar']));
    }

    /**
     *
     */
    function test_args_empty()
    {
        $function = fn() => func_get_args();

        $this->assertEquals([], Signal::emit($function));
    }

    /**
     *
     */
    function test_args_named()
    {
        $function = fn($foo) => $foo;

        $this->assertEquals('bar', Signal::emit($function, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_args_optional()
    {
        $function = fn($foo = null) => $foo;

        $this->assertNull(Signal::emit($function));
    }

    /**
     *
     */
    function test_args_variadic()
    {
        $function = fn($foo, ...$args) => array_merge([$foo], $args);

        $this->assertEquals(['foo', 'bar'], Signal::emit($function, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_args_variadic_named()
    {
        $function = fn($foo, ...$args) => array_merge([$foo], $args);

        $this->assertEquals(['bar', 'bat'], Signal::emit($function, ['foo' => 'bar', 'baz' => 'bat']));
    }

    /**
     *
     */
    function test_null_param()
    {
        $function = fn($foo) => !$foo ? 'bar' : $foo;

        $this->assertEquals('bar', Signal::emit($function, ['foo' => null]));
    }

    /**
     *
     */
    function test_callback_missing_param()
    {
        $function = fn($foo) => $foo;

        $callback = fn($name) => 'foo' == $name ? 'bar' : null;

        $this->assertEquals('bar', Signal::emit($function, [], $callback));
    }

    /**
     * @runInSeparateProcess
     */
    function test_callback_missing_class_param()
    {
        $method = 'Mvc5\Service\Context::bind';

        $callback = fn($name) => Service::class == $name ? new App : null;

        $this->assertInstanceOf(App::class, Signal::emit($method, ['foo' => 'bar'], $callback));
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
        $this->expectExceptionMessage('Missing required parameter $plugin for Mvc5\App::__invoke');

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
        $function = fn($argv) => $argv;

        $this->assertEquals(['foo' => 'bar'], Signal::emit($function, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_with_argv()
    {
        $function = fn($foo, $argv) => ['foo' => $foo] + $argv;

        $args = ['foo' => 'bar', 'baz' => 'bat'];

        $this->assertEquals($args, Signal::emit($function, $args));
    }

    /**
     *
     */
    function test_with_argv_exception()
    {
        $function = fn($foo, $argv, $baz) => null;

        $args = ['foo' => 'bar', 'baz' => 'bat'];

        try {
            Signal::emit($function, $args);
        } catch(\ArgumentCountError $exception) {
            $this->assertEquals('Too few arguments to function Mvc5\Test\SignalTest::Mvc5\Test\{closure}(), 2 passed and exactly 3 expected', $exception->getMessage());
        } catch(\Throwable $exception) {
            $this->assertEquals('Missing argument 3 for Mvc5\Test\SignalTest::Mvc5\Test\{closure}()', $exception->getMessage());
        }
    }

    /**
     *
     */
    function test_variadic_argv()
    {
        $function = fn(...$argv) => $argv[0]->args();

        $this->assertEquals(['foo' => 'bar'], Signal::emit($function, ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_with_variadic_argv()
    {
        $function = fn($foo, ...$argv) => ['foo' => $foo] + $argv[0]->args();

        $args = ['foo' => 'bar', 'baz' => 'bat'];

        $this->assertEquals($args, Signal::emit($function, $args));
    }
}
