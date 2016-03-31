<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Plugin\SignalArgs as Args;
use Mvc5\Test\Test\TestCase;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Args::class, new Args([]));
    }

    /**
     *
     */
    public function test_args()
    {
        $args = new Args([]);

        $this->assertEquals([], $args->args());
    }
}
