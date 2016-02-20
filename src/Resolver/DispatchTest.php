<?php
/**
 *
 */

namespace Mvc5\Test\Resolver;

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
    public function test_invoke_stopped()
    {
        $dispatch = new Dispatch;

        $this->assertEquals([], $dispatch(function(){ return []; }));

        $this->assertTrue($dispatch->stopped());
    }

    /**
     *
     */
    public function test_invoke_resolvable_not_stopped()
    {
        $dispatch = new Dispatch;

        $this->assertInstanceOf(Resolvable::class, $dispatch(function() { return new Config; }));

        $this->assertFalse($dispatch->stopped());
    }

    /**
     *
     */
    public function test_invoke_null_not_stopped()
    {
        $dispatch = new Dispatch;

        $this->assertNull($dispatch(function(){ return null; }));

        $this->assertFalse($dispatch->stopped());
    }
}
