<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class CombineTest
    extends TestCase
{
    /**
     *
     */
    public function test_combine()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['combine', 'combineTest']);

        $mock->expects($this->once())
            ->method('compose')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->combineTest(['foo']));
    }
}
