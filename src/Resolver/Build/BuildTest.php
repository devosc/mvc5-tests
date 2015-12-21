<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class BuildTest
    extends TestCase
{
    /**
     *
     */
    public function test_build()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['build', 'buildTest']);

        $mock->expects($this->once())
             ->method('compose')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->buildTest(['foo']));
    }
}
