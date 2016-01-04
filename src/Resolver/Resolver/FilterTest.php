<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    public function test_filter()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['callable', 'filter', 'filterTest', 'invoke', 'signal']);

        $this->assertEquals('foo', $mock->filterTest(null, [function() { return 'foo'; }]));
    }
}
