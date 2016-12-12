<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Scoped;
use Mvc5\Plugin\ScopedCall;
use Mvc5\Test\Test\TestCase;

class ScopedCallTest
    extends TestCase
{
    /**
     *
     */
    function test_scoped_call()
    {
        $plugin = new ScopedCall([$this, 'foo'], ['bar' => 'baz']);

        $this->assertEquals(['bar' => 'baz'], $plugin->args());
        $this->assertInstanceOf(Scoped::class, $plugin->config());
    }

    /**
     *
     */
    function foo()
    {
    }
}
