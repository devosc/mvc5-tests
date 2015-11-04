<?php

namespace Mvc5\Test\Service\Resolver;

use Mvc5\Service\Config\ConfigLink\ConfigLink;
use Mvc5\Test\Test\TestCase;

class SignalTest
    extends TestCase
{
    /**
     *
     */
    public function test_signal_with_numeric_args()
    {
        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals('foo', $mock->testSignal(function() { return 'foo'; }, ['bar']));
    }

    /**
     *
     */
    public function test_signal_without_args()
    {
        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals('foo', $mock->testSignal(function() { return 'foo'; }));
    }

    /**
     *
     */
    public function test_signal_array()
    {
        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals('bar', $mock->testSignal([Signal::class, 'staticTest'], ['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_signal_static_string()
    {
        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $name = Signal::class.'::'.'staticRequiredTest';

        $this->assertEquals('bar baz', $mock->testSignal($name, ['foo' => 'bar'], function($name) {
            if (ConfigLink::class == $name) {
                return new ConfigLink;
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
        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $name = Signal::class.'::'.'staticRequiredExceptionTest';

        $this->setExpectedException('RuntimeException');

        $mock->testSignal($name, ['foo' => 'bar']);
    }

    /**
     *
     */
    public function test_signal_php_function()
    {
        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals(null, $mock->testSignal('session_id'));
    }
}
