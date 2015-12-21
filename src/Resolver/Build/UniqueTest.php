<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class UniqueTest
    extends TestCase
{
    /**
     *
     */
    public function test_unique_same()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['unique', 'uniqueTest']);

        $mock->expects($this->once())
             ->method('callback')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->uniqueTest('foo', 'foo'));
    }

    /**
     *
     */
    public function test_unique_parent()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['unique', 'uniqueTest']);

        $mock->expects($this->once())
             ->method('__invoke')
             ->willReturn('bar');

        $this->assertEquals('bar', $mock->uniqueTest('foo', 'baz'));
    }
}
