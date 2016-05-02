<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class EventTest
    extends TestCase
{
    /**
     *
     */
    function test_event()
    {
        $resolver = new Resolver;

        $resolver->events(['foo' => [function() { return 'bar'; }]]);

        $this->assertEquals('bar', $resolver->event('foo'));
    }
}
