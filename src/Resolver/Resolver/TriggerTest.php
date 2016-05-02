<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Event;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class TriggerTest
    extends TestCase
{
    /**
     *
     */
    function test_trigger()
    {
        $resolver = new Resolver;

        $resolver->configure('event\model', Event::class);

        $resolver->events(['service\resolver' => [function() { return 'bar'; }]]);

        $this->assertEquals('bar', $resolver->trigger('service\resolver'));
    }
}
