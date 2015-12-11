<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ParentTest
    extends TestCase
{
    /**
     *
     */
    public function test_parent()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['parent', 'parentTest']);

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('bar');

        $mock->expects($this->once())
             ->method('configured')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->parentTest('foo.bar'));
    }
}
