<?php

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Filter;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    public function test_config()
    {
        /** @var Filter|Mock $mock */

        $mock = $this->getCleanMock(Filter::class, ['config'], ['foo']);

        $this->assertEquals('foo', $mock->config());
    }

    /**
     *
     */
    public function test_filter()
    {
        /** @var Filter|Mock $mock */

        $mock = $this->getCleanMock(Filter::class, ['filter']);

        $this->assertEquals(null, $mock->filter());
    }
}
