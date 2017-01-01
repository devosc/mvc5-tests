<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Shared;
use Mvc5\Test\Test\TestCase;

class SharedTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $shared = new Shared('foo', 'bar');

        $this->assertEquals('foo', $shared->name());
        $this->assertEquals('bar', $shared->config());
    }
}
