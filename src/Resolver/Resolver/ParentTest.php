<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class ParentTest
    extends TestCase
{
    /**
     *
     */
    public function test_parent()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', 'bar');

        $this->assertEquals('bar', $resolver->parent('foo'));
    }
}
