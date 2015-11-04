<?php

namespace Mvc5\Test\Service\Config\Filter;

use Mvc5\Service\Config\Filter\Filter;
use Mvc5\Test\Test\TestCase;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    public function test_config()
    {
        $mock = $this->getCleanMock(Filter::class, ['config'], ['foo']);

        $this->assertEquals('foo', $mock->config());
    }

    /**
     *
     */
    public function test_filter()
    {
        $mock = $this->getCleanMock(Filter::class, ['filter']);

        $this->assertEquals(null, $mock->filter());
    }
}
