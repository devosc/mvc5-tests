<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $resolver = new Resolver;

        $this->assertEquals(false, $resolver->args(false));
    }

    /**
     *
     */
    public function test_args_not_array()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->args('foo'));
    }

    /**
     *
     */
    public function test_args_array()
    {
        $resolver = new Resolver;

        $this->assertEquals(['foo' => new Config], $resolver->args(['foo' => new Plugin(Config::class)]));
    }
}
