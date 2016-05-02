<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use Mvc5\Test\Resolver\Resolver\Model\CallableObject;

class RepeatTest
    extends TestCase
{
    /**
     *
     */
    function test_repeat_no_config()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->repeat(CallableObject::class, 'test'));
    }

    /**
     *
     */
    function test_repeat_config()
    {
        $resolver = new Resolver;

        $this->assertEquals('foo', $resolver->repeat(CallableObject::class, 'test2', ['test3']));
    }
}
