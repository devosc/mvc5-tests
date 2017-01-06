<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Dispatch;

use Mvc5\Plugin\Config;
use Mvc5\Resolver\Dispatch;
use Mvc5\Resolvable;
use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    function test_stopped()
    {
        $dispatch = new Dispatch;

        $this->assertEquals([], $dispatch(function(){ return []; }));

        $this->assertTrue($dispatch->stopped());
    }

    /**
     *
     */
    function test_resolvable_not_stopped()
    {
        $dispatch = new Dispatch;

        $this->assertInstanceOf(Resolvable::class, $dispatch(function() { return new Config; }));

        $this->assertFalse($dispatch->stopped());
    }

    /**
     *
     */
    function test_null_not_stopped()
    {
        $dispatch = new Dispatch;

        $this->assertNull($dispatch(function(){ return null; }));

        $this->assertFalse($dispatch->stopped());
    }
}
