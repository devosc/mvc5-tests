<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class MergeTest
    extends TestCase
{
    /**
     *
     */
    public function test_merge()
    {
        $resolver = new Resolver;

        $parent = new Plugin('foo', ['foo' => 'bar']);

        $config = new Plugin('bar', ['foo' => 'baz'], ['a' => 'b'], true, 'item');

        $this->assertInstanceOf(Plugin::class, $resolver->merge($parent, $config));
    }

    /**
     *
     */
    public function test_merge_no_parent_name()
    {
        $resolver = new Resolver;

        $parent = new Plugin(null);

        $config = new Plugin('bar');

        $this->assertInstanceOf(Plugin::class, $resolver->merge($parent, $config));
    }

    /**
     *
     */
    public function test_merge_no_merge_parent_calls()
    {
        $resolver = new Resolver;

        $parent = new Plugin('foo');

        $config = new Plugin('bar', [], ['a' => 'b']);

        $this->assertInstanceOf(Plugin::class, $resolver->merge($parent, $config));
    }
}
