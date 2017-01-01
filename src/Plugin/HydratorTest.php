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
    function test()
    {
        $hydrator = new Hydrator('foo', []);

        $this->assertEquals('foo', $hydrator->name());
        $this->assertEquals([], $hydrator->args());
        $this->assertEquals('item', $hydrator->param());
    }
}
