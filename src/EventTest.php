<?php
/**
 *
 */

namespace Mvc5\Test;

use Mvc5\Event;
use Mvc5\Test\Test\TestCase;

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
}
