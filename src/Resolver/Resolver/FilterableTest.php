<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Filter;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class FilterableTest
    extends TestCase
{
    /**
     *
     */
    public function test_filterable()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->filterable(new Filter('foo', [function($foo) { return $foo; }])));
    }
}
