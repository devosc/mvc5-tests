<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Config;
use Mvc5\Container;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class CompositeTest
    extends TestCase
{
    /**
     *
     */
    public function test_composite_service_manager()
    {
        $plugin   = new App([Arg::SERVICES => ['foo' => Config::class]]);

        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->composite($plugin, 'foo'));
    }

    /**
     *
     */
    public function test_composite_service_container()
    {
        $plugin   = new Container(['foo' => 'bar']);
        $resolver = new Resolver;

        $resolver->configure('bar', Config::class);

        $this->assertInstanceOf(Config::class, $resolver->composite($plugin, 'foo'));
    }

    /**
     *
     */
    public function test_composite_array_access()
    {
        $plugin   = ['foo' => new Plugin(Config::class)];
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->composite($plugin, 'foo'));
    }
}
