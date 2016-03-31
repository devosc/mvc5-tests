<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\CallEvent;
use Mvc5\Test\Test\TestCase;

class ListenerTest
    extends TestCase
{
    /**
     *
     */
    public function test_listener_not_event()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->listener('foo'));
    }

    /**
     *
     */
    public function test_listener_event()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(\Closure::class, $resolver->listener(new CallEvent));
    }
}
