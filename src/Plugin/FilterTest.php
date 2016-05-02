<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Filter;
use Mvc5\Test\Test\TestCase;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Filter::class, new Filter([]));
    }

    /**
     *
     */
    function test_config()
    {
        $filter = new Filter(['foo']);

        $this->assertEquals(['foo'], $filter->config());
    }

    /**
     *
     */
    function test_filter()
    {
        $filter = new Filter([], ['foo']);

        $this->assertEquals(['foo'], $filter->filter());
    }

    /**
     *
     */
    function test_args()
    {
        $filter = new Filter([], [], ['foo']);

        $this->assertEquals(['foo'], $filter->args());
    }

    /**
     *
     */
    function test_param()
    {
        $filter = new Filter([], [], [], 'foo');

        $this->assertEquals('foo', $filter->param());
    }
}
