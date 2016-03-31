<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Build;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class CombineTest
    extends TestCase
{
    /**
     *
     */
    public function test_combine()
    {
        $resolver = new Resolver;

        $this->assertInstanceOf(Config::class, $resolver->combine([Config::class]));
    }
}
