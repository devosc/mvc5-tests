<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Config;
use Mvc5\Plugin\Factory;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class FactoryTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_factory()
    {
        $resolver = new Resolver;

        $resolver->configure('bar', function() { return function() { return 'baz'; }; });

        $resolver->configure('factory', new Plugin('bar'));

        $this->assertEquals('baz', $resolver->gem(new Factory('foo')));
    }
}
