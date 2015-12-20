<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InvokeTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['invoke', 'invokeTest']);

        $mock->expects($this->once())
            ->method('signal')
            ->willReturn(function() {});

        $this->assertEquals(function() {}, $mock->invokeTest(function() {}));
    }
}
