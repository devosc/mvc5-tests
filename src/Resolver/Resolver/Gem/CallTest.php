<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Call;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Resolver\Resolver\Model\CallObject;
use Mvc5\Test\Test\TestCase;

class CallTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_call_named()
    {
        $resolver = new Resolver;

        $call = new Call(CallObject::class, ['foo' => 'foo']);

        $this->assertEquals('foo', $resolver->gem($call, ['bar' => 'bar']));
    }

    /**
     *
     */
    public function test_gem_call_not_named()
    {
        $resolver = new Resolver;

        $call = new Call(CallObject::class, ['bar']);

        $this->assertEquals('foo', $resolver->gem($call, ['foo']));
    }
}
