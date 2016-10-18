<?php
/**
 *
 */

namespace Mvc5\Test\Url\Route;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $route = [
        'name'        => 'app',
        'route'       => '/[{controller}[/{action}]]',
        'wildcard'    => true,
        'constraints' => ['controller' => '[a-zA-Z0-9_-]*', 'action' => '[a-zA-Z0-9_-]*'],
        'defaults'    => ['controller' => 'home', 'action' => 'index'],
        'tokens'      => [
            ['literal', '/'],
            ['optional-start'],
            ['param', 'controller', '[a-zA-Z0-9_-]*'],
            ['optional-start'],
            ['literal', '/'],
            ['param','action', '[a-zA-Z0-9_-]*'],
            ['optional-end'],
            ['optional-end']
        ],
        'regex'  => '/(?:(?P<controller>[a-zA-Z0-9_-]*)(?:/(?P<action>[a-zA-Z0-9_-]*))?)?',
    ];

    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Generator::class, new Generator);
    }

    /**
     *
     */
    function test_child()
    {
        $route = new Route([
            Arg::NAME => 'app',
            Arg::CHILDREN => [
                'foo' => ['route' => '/foo']
            ]
        ]);

        $generator  = new Generator($route);

        $this->assertInstanceOf(Route::class, $generator->child($route, 'foo'));
    }

    /**
     *
     */
    function test_config()
    {
        $route = new Route([Arg::NAME => 'app']);
        $generator  = new Generator($route);

        $this->assertEquals($route, $generator->config('app'));
    }

    /**
     *
     */
    function test_config_child()
    {
        $route = new Route([Arg::NAME => 'app', Arg::CHILDREN => ['foo' => 'bar']]);
        $generator  = new Generator($route);

        $this->assertEquals('bar', $generator->config('foo'));
    }

    /**
     *
     */
    function test_generate()
    {
        $generator = new Generator(new Route($this->route));

        $this->assertEquals('/foo/bar', $generator->generate('app', ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_generate_child()
    {
        $route = new Route([
            Arg::NAME     => 'app',
            Arg::ROUTE    => '/',
            Arg::CHILDREN => [
                'foo' => [
                    Arg::ROUTE => 'foo/{controller}',
                    Arg::CHILDREN => [
                        'bar' => [
                            Arg::ROUTE => '/bat'
                        ]
                    ]
                ]
            ]
        ]);

        $generator = new Generator;

        $this->assertEquals(
            'foo/baz/bat', $generator->generate('foo/bar', ['controller' => 'baz'], [], null, $route)
        );
    }

    /**
     *
     */
    function test_generate_wildcard()
    {
        $generator = new Generator(new Route($this->route));

        $this->assertEquals('/foo/bar', $generator->generate('app', ['controller' => 'foo', 'action' => 'bar']));
    }

    /**
     *
     */
    function test_generate_wildcard_defaults()
    {
        $generator = new Generator(new Route($this->route));

        $this->assertEquals('/', $generator->generate('app', ['controller' => 'home', 'action' => 'index']));
    }

    /**
     *
     */
    function test_merge()
    {
        $generator  = new Generator;

        $parent = new Route([Arg::SCHEME => 'https', Arg::HOST => 'localhost', Arg::PORT => '443']);

        $child = $generator->merge($parent, new Route);

        $this->assertTrue($parent == $child);

        $this->assertTrue($parent !== $child);

        $this->assertEquals('https', $child->scheme());

        $this->assertEquals('localhost', $child->host());

        $this->assertEquals('443', $child->port());
    }

    /**
     *
     */
    function test_name()
    {
        $route = new Route([Arg::NAME => 'app']);
        $generator  = new Generator($route);

        $this->assertEquals('app', $generator->name('app'));
    }

    /**
     *
     */
    function test_name_not_exists()
    {
        $route = new Route([Arg::NAME => 'app']);

        $generator = new Generator($route);

        $this->assertEquals('app/foo', $generator->name('foo'));
    }

    /**
     *
     */
    function test_options()
    {
        $generator = new Generator;

        $defaults = $generator->options();

        $options = [Arg::HOST => 'foo'];

        $this->assertEquals($options + $defaults, $generator->options($options));
    }

    /**
     *
     */
    function test_url()
    {
        $generator = new Generator([Arg::NAME => 'app']);

        $this->assertInstanceOf(Route::class, $generator->url($this->route));
    }

    /**
     *
     */
    function test_url_with_no_build()
    {
        $route = new Route($this->route);
        $generator  = new Generator([Arg::NAME => 'app']);

        $this->assertEquals($route, $generator->url($route));
    }

    /**
     *
     */
    function test_invoke()
    {
        $generator = new Generator([Arg::NAME => 'app', Arg::ROUTE => '/foo']);

        $this->assertEquals('/foo', $generator('app'));
    }

    /**
     *
     */
    function test_invoke_no_path()
    {
        $generator = new Generator([Arg::NAME => 'app', Arg::ROUTE => '/']);

        $this->assertEquals('/', $generator('app'));
    }

    /**
     *
     */
    function test_invoke_canonical_and_wildcard_params()
    {
        $generator = new Generator([Arg::NAME => 'app', Arg::ROUTE => '/', Arg::WILDCARD => true]);

        $options = [Arg::SCHEME => 'https', Arg::HOST => 'localhost', Arg::PORT => '443', Arg::CANONICAL => true];

        $this->assertEquals('https://localhost/foo/bar', $generator('app', ['foo' => 'bar'], $options));
    }
}
