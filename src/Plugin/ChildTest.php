<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Child;
use Mvc5\Plugin\Plugin;
use Mvc5\Model;
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

    /**
     *
     */
    function test_merge_no_parent_name()
    {
        $app = new App([
            'services' => [
                'form' => new Plugin(null, [['foo' => 'bar']]),
                'foo' => new Child(Config::class, 'form')
            ]
        ]);

        $form = $app->plugin('foo');

        $this->assertInstanceOf(Config::class, $form);
        $this->assertEquals('bar', $form->get('foo'));
    }

    /**
     *
     */
    function test_merge_with_parent_calls()
    {
        $app = new App([
            'services' => [
                'foo' => new Plugin(Model::class, [['foo' => 'bar']], [['set', ['foobar' => 'bar']]]),
                'bar' => new Plugin('foo', [['foo' => 'baz']], [['set', ['a' => 'b']]], null, true)
            ]
        ]);

        $this->assertEquals(new Model(['foo' => 'baz', 'foobar' => 'bar', 'a' => 'b']), $app->plugin('bar'));
    }

    /**
     *
     */
    function test_merge_without_parent_calls()
    {
        $app = new App([
            'services' => [
                'foo' => new Plugin(Model::class, [['foo' => 'bar']], [['set', ['foobar' => 'bat']]]),
                'bar' => new Plugin('foo', [['foo' => 'baz']], [['set', ['a' => 'b']]])
            ]
        ]);

        $this->assertEquals(new Model(['foo' => 'baz', 'a' => 'b']), $app->plugin('bar'));
    }

    /**
     *
     */
    function test_named_args()
    {
        $app = new App([
            'services' => [
                'foo' => new Plugin(Model::class, ['template' => 'bar']),
                'bar' => new Plugin('foo', ['template' => 'baz']),
            ]
        ]);

        $this->assertEquals(new Model('baz'), $app->plugin('bar'));
    }

    /**
     *
     */
    function test_plugin()
    {
        $app = new App;
        $app->configure('bar', new Plugin(Config::class));

        $this->assertInstanceOf(Config::class, $app->plugin(new Child('foo', 'bar')));
    }

    /**
     *
     */
    function test_replace_args()
    {
        $app = new App([
            'services' => [
                'bar' => new Plugin(Config::class, [['a', 'b', 'c']]),
                'foo' => new Plugin('bar', [['foo', 'bar']])
            ]
        ]);

        $this->assertEquals(new Config(['foo', 'bar']), $app->plugin('foo'));
    }
}
