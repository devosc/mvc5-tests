<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Plugin\Config\Child;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    public function test_parent()
    {
        /** @var Child|Mock $mock */

        $mock = $this->getCleanMockForTrait(Child::class, ['parent']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->parent());
    }
}
