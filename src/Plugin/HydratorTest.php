<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Hydrator;
use Mvc5\Test\Test\TestCase;

class HydratorTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Hydrator::class, new Hydrator('foo', []));
    }
}
