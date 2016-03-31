<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Filter;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_filter()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->gem(new Filter('foo', [function($foo) { return $foo; }])));
    }
}
