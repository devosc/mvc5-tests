<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Scoped;
use Mvc5\Test\Test\TestCase;

class ScopedTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $scoped = new Scoped([$this, 'foo']);

        $this->assertInstanceOf(\Closure::class, $scoped->closure());
    }

    /**
     * @return \Closure
     */
    function foo()
    {
        return function() {};
    }
}
