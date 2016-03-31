<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Param;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ParamTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_param()
    {
        $resolver = new Resolver;

        $resolver->config(['foo' => 'bar']);

        $this->assertEquals('bar', $resolver->gem(new Param('foo')));
    }
}
