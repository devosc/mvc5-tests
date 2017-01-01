<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Invoke;
use Mvc5\Test\Test\TestCase;

class InvokeTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $invoke = new Invoke('foo', ['bar']);

        $this->assertEquals('foo', $invoke->config());
        $this->assertEquals(['bar'], $invoke->args());
    }
}
