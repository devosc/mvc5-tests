<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Child;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    function test_child()
    {
        $resolver = new Resolver;

        $resolver->configure('bar', new Plugin(Config::class));

        $this->assertInstanceOf(Config::class, $resolver->child(new Child('foo', 'bar')));
    }
}
