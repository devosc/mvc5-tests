<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Config;
use Mvc5\Plugin\Child;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_child()
    {
        $resolver = new Resolver;

        $resolver->configure('bar', new Plugin(Config::class));

        $this->assertInstanceOf(Config::class, $resolver->gem(new Child('foo', 'bar')));
    }
}
