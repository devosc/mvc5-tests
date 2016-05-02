<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Event;
use Mvc5\Plugin\Plug;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver\Model\Unresolvable;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ResolvableTest
    extends TestCase
{
    /**
     *
     */
    function test_resolvable()
    {
        $resolver = new Resolver;

        $this->assertEquals(new Config, $resolver->resolvable(new Plugin(Config::class)));
    }

    /**
     *
     */
    function test_resolvable_not()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->resolvable('foo'));
    }

    /**
     *
     */
    function test_resolvable_recursion()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', new Plugin(Model\CallObject::class));

        $plugin = new Plug('foo');

        $this->assertInstanceOf(Model\CallObject::class, $resolver->resolvable($plugin));
    }

    /**
     *
     */
    function test_resolvable_recursion_exception()
    {
        $resolver = new Resolver;

        $resolver->configure('event\model', Event::class);

        $resolver->events(['service\resolver' => [function() { throw new \RuntimeException; }]]);

        $this->setExpectedException('RuntimeException');

        $resolver->resolvable(new Unresolvable);
    }
}
