<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Config;
use Mvc5\Plugin\Calls;
use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class CallsTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_calls()
    {
        $resolver = new Resolver;

        $this->assertEquals(
            new Config(['foo' => 'bar']), $resolver->gem(new Calls(new Plugin(Config::class), ['#foo' => 'bar']))
        );
    }
}
