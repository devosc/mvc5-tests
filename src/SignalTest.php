<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Plugin\Config;
use Mvc5\Plugin\Gem\Config as ConfigPlugin;
use Mvc5\Test\Test\TestCase;

class SignalTest
    extends TestCase
{
    /**
     *
     */
    function test_numeric_args()
    {
        $signal = new Signal;

        $this->assertEquals('foo', $signal->signal(function() { return 'foo'; }, ['bar']));
    }

    /**
     *
     */
    function test_empty_args()
    {
        $signal = new Signal;

        $this->assertEquals('foo', $signal->signal(function() { return 'foo'; }));
    }

    /**
     *
     */
    function test_optional_arg()
    {
        $signal = new Signal;

        $this->assertEquals('foo', $signal->signal([Signal::class, 'optionalArgTest']));
    }

    /**
     *
     */
    function test_named_arg()
    {
        $signal = new Signal;

        $this->assertEquals('bar', $signal->signal([Signal::class, 'staticTest'], ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_variadic_args()
    {
        $signal = new Signal;

        $this->assertEquals(['foo' => 'bar'], $signal->signal([Signal::class, 'variadicArgsTest'], ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_args()
    {
        $signal = new Signal;

        $this->assertEquals(['foo' => 'bar'], $signal->signal([Signal::class, 'argsTest'], ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_static_string()
    {
        $signal = new Signal;

        $method = 'Mvc5\Test\Signal::staticRequiredTest';

        $this->assertEquals('bar baz', $signal->signal($method, ['foo' => 'bar'], function($name) {
            if (ConfigPlugin::class == $name) {
                return new Config;
            }

            if ($name == 'baz') {
                return 'baz';
            }

            return null;
        }));
    }

    /**
     *
     */
    function test_no_param_function()
    {
        $signal = new Signal;

        $this->setExpectedException('RuntimeException', 'Missing required parameter $haystack for strpos');

        $signal->signal('strpos');
    }

    /**
     *
     */
    function test_no_param_exception_static_method()
    {
        $signal = new Signal;

        $method = 'Mvc5\Test\Signal::requiredExceptionTest';

        $this->setExpectedException('RuntimeException', 'Missing required parameter $baz for ' . $method);

        $signal->signal($method, ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_no_param_exception_class_method()
    {
        $signal = new Signal;

        $this->setExpectedException(
            'RuntimeException', 'Missing required parameter $baz for Mvc5\Test\Signal::requiredExceptionTest'
        );

        $signal->signal([new Signal, 'requiredExceptionTest'], ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_no_param_exception_invoke()
    {
        $signal = new Signal;

        $this->setExpectedException(
            'RuntimeException', 'Missing required parameter $baz for Mvc5\Test\Signal::__invoke'
        );

        $signal->signal(new Signal, ['foo' => 'bar']);
    }

    /**
     *
     */
    function test_php_function()
    {
        $signal = new Signal;

        $this->assertEmpty($signal->signal('session_id'));
    }
}
