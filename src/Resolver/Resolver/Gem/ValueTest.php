<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Value;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ValueTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_value()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->gem(new Value('foo')));
    }
}
