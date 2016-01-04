<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Filter;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class FilterableTest
    extends TestCase
{
    /**
     *
     */
    public function test_filterable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['filterable', 'filterableTest']);

        $mock->expects($this->once())
             ->method('filter')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->filterableTest(new Filter(null)));
    }
}
