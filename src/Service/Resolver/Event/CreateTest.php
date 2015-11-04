<?php

namespace Mvc5\Test\Service\Resolver\Event;

use Mvc5\Service\Resolver\Event\Create;
use Mvc5\Service\Resolver\Event\Dispatch;
use Mvc5\Test\Test\TestCase;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Create::class, ['__invoke']);

        $this->assertEquals(null, $mock->__invoke('foo'));
    }

    /**
     *
     */
    public function test_invoke_with_events()
    {
        $mock = $this->getCleanMock(Create::class, ['__invoke'], [['foo' => 'bar']]);

        $this->assertInstanceOf(Dispatch::class, $mock->__invoke('foo'));
    }

    /**
     *
     */
    public function test_invoke_with_events_and_callback()
    {
        $mock = $this->getCleanMock(Create::class, ['__invoke'], [['foo' => 'bar'], function() { return 'bar'; }]);

        $this->assertEquals('bar', $mock->__invoke('foo'));
    }
}
