<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Event;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class StrictTest
    extends TestCase
{
    /**
     *
     */
    function test_strict()
    {
        $resolver = new Resolver;

        $this->assertEquals(false, $resolver->strict());
    }
}
