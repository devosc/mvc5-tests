<?php

namespace Mvc5\Test\Event\Manager;

use Mvc5\Test\Test\TestCase;

class EmitTest
    extends TestCase
{
    /**
     *
     */
    public function test_emit_callable()
    {
        $mock = $this->getCleanAbstractMock(Events::class, ['emit', 'testEmit']);

        $this->assertEquals('foo', $mock->testEmit(function() { return 'foo'; }, function() {}));
    }

    /**
     *
     */
    public function test_emit_not_callable()
    {
        $mock = $this->getCleanAbstractMock(Events::class, ['emit', 'testEmit']);

        $mock->expects($this->once())
             ->method('invoke')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testEmit(null, function() {}));
    }
}
