<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\SignalArgs;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class VariadicTest
    extends TestCase
{
    /**
     *
     */
    public function test_variadic_args()
    {
        $resolver = new Resolver;

        $this->assertEquals(['foo'], $resolver->variadic([new SignalArgs(['foo'])]));
    }

    /**
     *
     */
    public function test_variadic_not_args()
    {
        $resolver = new Resolver;

        $this->assertEquals(['foo'], $resolver->variadic(['foo']));
    }
}
