<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Value;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class MergeTest
    extends TestCase
{
    /**
     *
     */
    function test_merge_with_not_named_args()
    {
        $resolver = new Resolver;

        $parent = new Plugin('foo', ['foo', 'bar']);

        $config = new Plugin('bar', ['a', 'b']);

        $result = new Plugin('foo', ['a', 'b']);

        $this->assertEquals($result, $resolver->merge($parent, $config));
    }

    /**
     *
     */
    function test_merge_with_named_args()
    {
        $resolver = new Resolver;

        $parent = new Plugin('foo', ['foo' => 'bar', 'c' => 'd']);

        $config = new Plugin('bar', ['a' => 'b', 'foo' => 'baz']);

        $result = new Plugin('foo', ['a' => 'b', 'foo' => 'baz', 'c' => 'd']);

        $this->assertEquals($result, $resolver->merge($parent, $config));
    }

    /**
     *
     */
    function test_merge_with_parent_calls()
    {
        $resolver = new Resolver;

        $parent = new Plugin('foo', ['foo' => 'bar'], ['a']);

        $config = new Plugin('bar', ['foo' => 'baz', 'a' => 'a'], ['b'], null, true);

        $result = new Plugin('foo', ['foo' => 'baz', 'a' => 'a'], ['a', 'b']);

        $this->assertEquals($result, $resolver->merge($parent, $config));
    }

    /**
     *
     */
    function test_merge_do_not_merge_parent_calls()
    {
        $resolver = new Resolver;

        $parent = new Plugin('foo', ['foo' => 'bar'], ['a']);

        $config = new Plugin('bar', ['foo' => 'baz', 'a' => 'a'], ['b']);

        $result = new Plugin('foo', ['foo' => 'baz', 'a' => 'a'], ['b']);

        $this->assertEquals($result, $resolver->merge($parent, $config));
    }

    /**
     *
     */
    function test_merge_specify_parent_name()
    {
        $resolver = new Resolver;

        $parent = new Plugin(null);

        $config = new Plugin(null);

        $result = new Plugin('foo');

        $this->assertEquals($result, $resolver->merge($parent, $config, 'foo'));
    }

    /**
     *
     */
    function test_merge_no_parent_name()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', 'bar');

        $parent = new Plugin(null);

        $config = new Plugin(new Value('foo'));

        $result = new Plugin('foo');

        $this->assertEquals($result, $resolver->merge($parent, $config));
    }

    /**
     *
     */
    function test_merge_param_name()
    {
        $resolver = new Resolver;

        $resolver->configure('foo', 'bar');

        $parent = new Plugin(null);

        $config = new Plugin(null, [], [], 'foo');

        $result = new Plugin(null, [], [], 'foo');

        $this->assertEquals($result, $resolver->merge($parent, $config));
    }
}
