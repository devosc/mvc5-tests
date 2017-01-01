<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\Plugin\Child;
use Mvc5\Test\Test\TestCase;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $child = new Child('foo', 'bar', ['baz']);

        $this->assertEquals('foo', $child->name());
        $this->assertEquals('bar', $child->parent());
        $this->assertEquals(['baz'], $child->args());
    }
}
