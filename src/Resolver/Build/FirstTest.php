<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class FirstTest
    extends TestCase
{
    /**
     *
     */
    function test_first_with_no_others()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->first(Config::class, []));
    }

    /**
     *
     */
    function test_first_with_others()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->first(Config::class, ['bar']));
    }
}
