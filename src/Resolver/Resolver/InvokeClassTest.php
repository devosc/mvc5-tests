<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class InvokeClassTest
    extends TestCase
{
    /**
     *
     */
    public function test_solve_invoke()
    {
        $resolver = new Resolver;

        $this->assertEquals(new Config, $resolver(Config::class));
    }
}
