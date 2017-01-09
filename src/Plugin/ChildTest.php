<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Config;
use Mvc5\Plugin\Child;
use Mvc5\Plugin\Plugin;
use Mvc5\Response\Config as Response;
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
                'foo' => new Plugin(Response::class, ['body' => 'foo'], ['status' => '200']),
                'bar' => new Plugin('foo', ['body' => 'bar'], [], null, true)
            ]
        ]);

        $this->assertEquals(new Response('bar', '200'), $app->plugin('bar'));
    }

    /**
     *
     */
    function test_merge_without_parent_calls()
    {
        $app = new App([
            'services' => [
                'foo' => new Plugin(Response::class, ['body' => 'foo'], ['status' => '200']),
                'bar' => new Plugin('foo', ['status' => '404'], ['body' => 'bar'])
            ]
        ]);

        $this->assertEquals(new Response('bar', '404'), $app->plugin('bar'));
    }

    /**
     *
     */
    function test_named_args()
    {
        $app = new App([
            'services' => [
                'foo' => new Plugin(Response::class, ['body' => 'foo', 'status' => '200']),
                'bar' => new Plugin('foo', ['status' => '404']),
            ]
        ]);

        $this->assertEquals(new Response('foo', '404'), $app->plugin('bar'));
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
