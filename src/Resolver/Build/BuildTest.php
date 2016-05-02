<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class BuildTest
    extends TestCase
{
    /**
     *
     */
    function test_build()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', Config::class);

        $this->assertInstanceOf(Config::class, $resolver->build(['foo']));
    }
}
