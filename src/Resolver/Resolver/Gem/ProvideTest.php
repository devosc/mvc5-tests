<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Provide;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ProvideTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_provide()
    {
        $resolver = new Resolver;

        $resolver->setProvider(function($foo) { return $foo; });

        $this->assertEquals('bar', $resolver->gem(new Provide('bar')));
    }

    /**
     *
     */
    public function test_gem_provide_no_provider()
    {
        $resolver = new Resolver;

        $this->setExpectedException(\RuntimeException::class, 'Unresolvable plugin: bar');

        $resolver->gem(new Provide('bar'));
    }
}
