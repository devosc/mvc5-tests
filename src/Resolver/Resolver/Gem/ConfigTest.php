<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Config;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_config()
    {
        $resolver = new Resolver;

        $resolver->config(['foo' => 'bar']);

        $this->assertEquals(['foo' => 'bar'], $resolver->gem(new Config));
    }
}
