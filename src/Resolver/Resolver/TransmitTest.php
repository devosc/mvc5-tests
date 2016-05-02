<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class TransmitTest
    extends TestCase
{
    /**
     *
     */
    function test_transmit()
    {
        $resolver = new Resolver;

        $this->assertEquals(phpversion(), $resolver->transmit(['@phpversion']));
    }
}
