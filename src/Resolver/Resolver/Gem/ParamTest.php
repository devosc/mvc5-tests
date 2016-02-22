<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Param;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ParamTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_param()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['gem', 'gemTest']);

        $mock->expects($this->once())
            ->method('param');

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->gemTest(new Param('foo')));
    }
}
