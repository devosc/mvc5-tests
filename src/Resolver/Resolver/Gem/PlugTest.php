<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Plug;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class PlugTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_plug()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', 'bar');

        $this->assertEquals('bar', $resolver->gem(new Plug('foo')));
    }
}
