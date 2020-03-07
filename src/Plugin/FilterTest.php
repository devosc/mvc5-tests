<?php
/**
 *
 */

namespace Mvc5\Test\Plugin;

use Mvc5\App;
use Mvc5\Plugin\Args;
use Mvc5\Plugin\Filter;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Value;
use Mvc5\Test\Test\TestCase;

class FilterTest
    extends TestCase
{
    /**
     * @throws \Throwable
     */
    function test()
    {
        $filter = new Filter(['foo'], ['bar'], ['baz'], 'foobar');

        $this->assertEquals(['foo'],  $filter->config());
        $this->assertEquals(new Value(['bar']),  $filter->plugin());
        $this->assertEquals(['baz'],  $filter->args());
        $this->assertEquals('foobar', $filter->param());
    }

    /**
     * @throws \Throwable
     */
    function test_resolvable_filter()
    {
        $filter = new Filter(['foo'], new Plugin('bar'));

        $this->assertEquals(['foo'],  $filter->config());
        $this->assertEquals(new Plugin('bar'),  $filter->plugin());
    }

    /**
     * @throws \Throwable
     */
    function test_args_plugin()
    {
        $plugin = new Args([fn($foo) => $foo]);

        $this->assertEquals('foo', (new App)->plugin(new Filter('foo', $plugin)));
    }

    /**
     * @throws \Throwable
     */
    function test_false()
    {
        $app = new App([
            'filters' => [
                'foo' => [
                    fn($foo) => $foo,
                    fn($foo, $baz) => $foo . $baz,
                    fn() => false,
                    fn($foo, $baz, $bar) => $foo . $bar
                ]
            ],
            'services' => [
                'bar' => fn() => 'bar',
                'foo' => new Filter('foo', new Param('filters.foo'), ['bar'])
            ]
        ]);

        $this->assertEquals('foos', $app->plugin('foo', ['s']));
    }

    /**
     * @throws \Throwable
     */
    function test_merge_param()
    {
        $app = new App([
            'filters' => [
                'foo' => [
                    fn($foo) => $foo,
                    fn($foo, $baz, $bar) => $foo . $bar . $baz
                ]
            ],
        ]);

        $this->assertEquals('foobars', $app->plugin(new Filter('foo', new Param('filters.foo'), ['bar']), ['s']));
    }

    /**
     * @throws \Throwable
     */
    function test_named_param()
    {
        $app = new App([
            'filters' => [
                'foo' => [
                    fn($foo, $o) => $foo . $o,
                    fn($foo, $baz, $bar) => $foo . $bar . $baz
                ]
            ],
            'services' => [
                'bar' => fn() => 'bar',
            ]
        ]);

        $this->assertEquals(
            'foobars', $app->plugin(new Filter('fo', new Param('filters.foo'), ['o' => 'o'], 'foo'), ['baz' => 's'])
        );
    }

    /**
     * @throws \Throwable
     */
    function test_null()
    {
        $app = new App([
            'filters' => [
                'foo' => [
                    fn($foo) => $foo,
                    fn($foo, $baz) => $foo . $baz,
                    fn() => null,
                    fn($foo, $baz, $bar) => $foo . $bar
                ]
            ],
        ]);

        $this->assertNull($app->plugin(new Filter('foo', new Param('filters.foo'), ['bar']), ['s']));
    }
}
