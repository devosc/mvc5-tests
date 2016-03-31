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
    public function test_signal_with_numeric_args()
    {
        $signal = new Signal;

        $this->assertEquals('foo', $signal->signal(function() { return 'foo'; }, ['bar']));
    }

    /**
     *
     */
    public function test_signal_without_args()
    {
        $signal = new Signal;

        $this->assertEquals('foo', $signal->signal(function() { return 'foo'; }));
    }

    /**
     *
     */
    public function test_signal_with_optional_arg()
    {
        $signal = new Signal;

        $this->assertEquals('foo', $signal->signal([Signal::class, 'optionalArgTest']));
    }

    /**
     *
     */
    public function test_signal_array()
    {
        $signal = new Signal;

        $this->assertEquals('bar', $signal->signal([Signal::class, 'staticTest'], ['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_signal_variadic_args()
    {
        $signal = new Signal;

        $this->assertEquals(['foo' => 'bar'], $signal->signal([Signal::class, 'variadicArgsTest'], ['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_signal_args()
    {
        $signal = new Signal;

        $this->assertEquals(['foo' => 'bar'], $signal->signal([Signal::class, 'argsTest'], ['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_signal_static_string()
    {
        $signal = new Signal;

        $name = 'Mvc5\Test\Signal::staticRequiredTest';

        $this->assertEquals('bar baz', $signal->signal($name, ['foo' => 'bar'], function($name) {
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
    public function test_signal_no_param_exception()
    {
        $signal = new Signal;

        $name = 'Mvc5\Test\Signal::staticRequiredExceptionTest';

        $this->setExpectedException('RuntimeException');

        $signal->signal($name, ['foo' => 'bar']);
    }

    /**
     *
     */
    public function test_signal_php_function()
    {
        $signal = new Signal;

        $this->assertEquals(null, $signal->signal('session_id'));
    }
}
