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
        /** @var Signal $mock */

        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals('foo', $mock->testSignal(function() { return 'foo'; }, ['bar']));
    }

    /**
     *
     */
    public function test_signal_without_args()
    {
        /** @var Signal $mock */

        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals('foo', $mock->testSignal(function() { return 'foo'; }));
    }

    /**
     *
     */
    public function test_signal_with_optional_arg()
    {
        /** @var Signal $mock */

        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals('foo', $mock->testSignal([Signal::class, 'optionalArgTest']));
    }

    /**
     *
     */
    public function test_signal_array()
    {
        /** @var Signal $mock */

        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals('bar', $mock->testSignal([Signal::class, 'staticTest'], ['foo' => 'bar']));
    }

    /**
     *
     */
    public function test_signal_static_string()
    {
        /** @var Signal $mock */

        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $name = Signal::class.'::'.'staticRequiredTest';

        $this->assertEquals('bar baz', $mock->testSignal($name, ['foo' => 'bar'], function($name) {
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
        /** @var Signal $mock */

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
        /** @var Signal $mock */

        $mock = $this->getCleanMock(Signal::class, ['signal', 'testSignal']);

        $this->assertEquals(null, $mock->testSignal('session_id'));
    }
}
