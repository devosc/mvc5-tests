<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Test\Test\TestCase;

class EventTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $event = new Event('foo');

        $this->assertEquals('foo', $event->event());
    }

    /**
     *
     */
    function test_args()
    {
        $event = new Event;

        $this->assertTrue(is_array($event->args()));
    }

    /**
     *
     */
    function test_invoke()
    {
        $event = new Event;

        $this->assertEquals('baz', $event(function($bar, $foo) { return $foo; }, ['bar', 'baz']));
    }

    /**
     *
     */
    function test_invoke_named()
    {
        $event = new Event;

        $this->assertEquals('bar', $event(function($bar, $foo) { return $foo; }, ['foo' => 'bar', 'bar' => 'baz']));
    }
}
