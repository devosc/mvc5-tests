<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Config;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_args()
    {
        $resolver = new Resolver;

        $this->assertEquals(['foo' => new Config], $resolver->gem(new Args(['foo' => new Plugin(Config::class)])));
    }
}
