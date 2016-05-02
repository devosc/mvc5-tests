<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Value;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class VarsTest
    extends TestCase
{
    /**
     *
     */
    function test_vars()
    {
        $resolver = new Resolver;

        $this->assertEquals(['foo', 'bar'], $resolver->vars(['foo'], ['bar']));
    }

    /**
     *
     */
    function test_vars_resolved()
    {
        $resolver = new Resolver;

        $this->assertEquals(['foo', 'bar'], $resolver->vars(['foo'], [new Value('bar')]));
    }
}
