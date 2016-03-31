<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Arg;
use Mvc5\Test\Test\TestCase;

class SignalTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $signal = new Signal;

        $this->assertEquals([Arg::EVENT => $signal], $signal->args());
    }

    /**
     *
     */
    public function test_invoke()
    {
        $signal = new Signal;

        $this->assertEquals('baz', $signal(function($bar, $foo){ return $foo; }, ['bar', 'baz']));
    }

    /**
     *
     */
    public function test_invoke_named()
    {
        $signal = new Signal;

        $this->assertEquals('bar', $signal(function($bar, $foo){ return $foo; }, ['bar' => 'baz', 'foo' => 'bar']));
    }
}
