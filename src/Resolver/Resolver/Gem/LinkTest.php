<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Link;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class LinkTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_link()
    {
        $resolver = new Resolver;

        $this->assertEquals($resolver, $resolver->gem(new Link()));
    }
}
