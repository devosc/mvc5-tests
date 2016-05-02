<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\Unresolvable;
use Mvc5\Test\Test\TestCase;
use RuntimeException;

class UnresolvableTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_unresolvable()
    {
        $resolver = new Resolver;

        $this->setExpectedException(RuntimeException::class);

        $resolver->gem(new Unresolvable);
    }
}
