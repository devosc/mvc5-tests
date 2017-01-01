<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Call;
use Mvc5\Test\Test\TestCase;

class CallTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $call = new Call('foo', ['bar']);

        $this->assertEquals('foo', $call->config());
        $this->assertEquals(['bar'], $call->args());
    }
}
