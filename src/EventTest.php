<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class EventTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        /** @var Event $mock */

        $mock = $this->getCleanMock(Event::class, ['event'], ['foo']);

        $this->assertEquals('foo', $mock->event());
    }

    /**
     *
     */
    public function test_args()
    {
        /** @var Event|Mock $mock */

        $mock = $this->getCleanMock(Event::class, ['args', 'argsTest']);

        $this->assertTrue(is_array($mock->argsTest()));
    }

    /**
     *
     */
    public function test_invoke()
    {
        $event = new Event;

        $this->assertEquals('baz', $event(function($bar, $foo) { return $foo; }, ['bar', 'baz']));
    }

    /**
     *
     */
    public function test_invoke_named()
    {
        $event = new Event;

        $this->assertEquals('bar', $event(function($bar, $foo) { return $foo; }, ['foo' => 'bar', 'bar' => 'baz']));
    }
}
