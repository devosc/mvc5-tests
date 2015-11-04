<?php

namespace Mvc5\Test\Event\Manager;

use Mvc5\Test\Test\TestCase;

class ListenersTest
    extends TestCase
{
    /**
     *
     */
    public function test_listeners()
    {
        $mock = $this->getCleanAbstractMock(ManageEvent::class, ['listeners', 'testListeners']);

        $this->assertEquals(null, $mock->testListeners(null));
    }
}
