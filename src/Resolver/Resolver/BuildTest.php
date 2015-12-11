<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class BuildTest
    extends TestCase
{
    /**
     *
     */
    public function test_build_one_with_callback()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['build', 'buildTest']);

        $this->assertEquals('bar', $mock->buildTest(['foo'], [], function() { return 'bar'; }));
    }

    /**
     *
     */
    public function test_build_one_without_callback()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['build', 'buildTest']);

        $mock->expects($this->once())
            ->method('make')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->buildTest(['foo']));
    }

    /**
     *
     */
    public function test_build_array()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['build', 'buildTest']);

        $mock->expects($this->once())
            ->method('compose')
            ->willReturn('baz');

        $this->assertEquals('baz', $mock->buildTest(['foo', 'bar']));
    }
}
