<?php

namespace Mvc5\Test\Event\Generator;

use Mvc5\Test\Test\TestCase;

class TraverseTest
    extends TestCase
{
    /**
     *
     */
    public function test_traverse()
    {
        $mock = $this->getCleanAbstractMock(EventGenerator::class, ['traverse', 'testTraverse']);

        $mock->expects($this->once())
             ->method('listener')
             ->willReturn('foo');

        foreach($mock->testTraverse([function() {}]) as $result) {
            $this->assertEquals('foo', $result);
        }
    }
}
