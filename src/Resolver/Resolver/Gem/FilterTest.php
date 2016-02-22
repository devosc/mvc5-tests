<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Filter;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_filter()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['gem', 'gemTest']);

        $mock->expects($this->once())
            ->method('filterable')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('args')
            ->willReturn([]);

        $mock->expects($this->once())
            ->method('arguments')
            ->willReturn([]);

        $this->assertEquals('foo', $mock->gemTest(new Filter('foo')));
    }
}
