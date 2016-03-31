<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Event;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ResolverTest
    extends TestCase
{
    /**
     *
     */
    public function test_resolver()
    {
        $resolver = new Resolver;

        $resolver->configure('event\model', Event::class);

        $resolver->events(['service\resolver' => [function() { return 'bar'; }]]);

        $this->assertEquals('bar', $resolver->resolver('foo'));
    }
}
