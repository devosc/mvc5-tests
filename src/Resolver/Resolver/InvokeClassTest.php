<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class InvokeClassTest
    extends TestCase
{
    /**
     *
     */
    public function test_solve__invoke()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['__invoke']);

        $mock->expects($this->once())
            ->method('plugin')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke('foo'));
    }
}
