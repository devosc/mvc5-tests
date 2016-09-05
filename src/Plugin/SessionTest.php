<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Arg;
use Mvc5\Plugin\Session;
use Mvc5\Resolvable;
use Mvc5\Test\Test\TestCase;

class SessionTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $plugin = new Session;

        $this->assertEquals(Arg::SESSION, $plugin->name());
        $this->assertInstanceOf(Resolvable::class, $plugin->config());
    }
}
