<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Event;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class SolveTest
    extends TestCase
{
    /**
     *
     */
    function test_solve_gem()
    {
        $resolver = new Resolver;

        $this->assertEquals(new Config, $resolver->solve(new Plugin(Config::class)));
    }

    /**
     *
     */
    function test_solve_callback()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->solve('foo', [], function($foo) { return $foo; }));
    }

    /**
     *
     */
    function test_solve_resolver()
    {
        $resolver = new Resolver;

        $resolver->configure('event\model', Event::class);

        $resolver->events(['service\resolver' => [function() { return 'bar'; }]]);

        $this->assertEquals('bar', $resolver->solve('foo'));
    }
}
