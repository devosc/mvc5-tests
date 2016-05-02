<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $definition = [
        'name'        => 'app',
        'route'       => '/[:controller[/:action]]',
        'wildcard'    => true,
        'constraints' => ['controller' => '[a-zA-Z0-9_-]*', 'action' => '[a-zA-Z0-9_-]*'],
        'defaults'    => ['controller' => 'home', 'action' => 'index'],
        'tokens'      => [
            ['literal', '/'],
            ['optional-start'],
            ['parameter', 'controller', null],
            ['optional-start'],
            ['literal', '/'],
            ['parameter','action', null],
            ['optional-end'],
            ['optional-end']
        ],
        'regex'       => '/(?:(?P<param1>[a-zA-Z0-9_-]*)(?:/(?P<param2>[a-zA-Z0-9_-]*))?)?',
        'paramMap'    => ['param1' => 'controller', 'param2' => 'action']
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
        $definition = new Definition([
            Arg::NAME => 'app',
            Arg::CHILDREN => [
                'foo' => ['route' => '/foo']
            ]
        ]);

        $generator  = new Generator($definition);

        $this->assertInstanceOf(Definition::class, $generator->child($definition, 'foo'));
    }

    /**
     *
     */
    function test_config()
    {
        $definition = new Definition([Arg::NAME => 'app']);
        $generator  = new Generator($definition);

        $this->assertEquals($definition, $generator->config('app'));
    }

    /**
     *
     */
    function test_config_child()
    {
        $definition = new Definition([Arg::NAME => 'app', Arg::CHILDREN => ['foo' => 'bar']]);
        $generator  = new Generator($definition);

        $this->assertEquals('bar', $generator->config('foo'));
    }

    /**
     *
     */
    function test_generate()
    {
        $generator = new Generator(new Definition($this->definition));

        $this->assertEquals('/foo/bar', $generator->generate('app', ['foo' => 'bar']));
    }

    /**
     *
     */
    function test_generate_child()
    {
        $definition = new Definition([
            Arg::NAME     => 'app',
            Arg::ROUTE    => '/',
            Arg::CHILDREN => [
                'foo' => [
                    Arg::ROUTE => 'foo/:controller',
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
            'foo/baz/bat', $generator->generate('foo/bar', ['controller' => 'baz'], [], null, $definition)
        );
    }

    /**
     *
     */
    function test_generate_wildcard()
    {
        $generator = new Generator(new Definition($this->definition));

        $this->assertEquals('/foo/bar', $generator->generate('app', ['controller' => 'foo', 'action' => 'bar']));
    }

    /**
     *
     */
    function test_generate_wildcard_defaults()
    {
        $generator = new Generator(new Definition($this->definition));

        $this->assertEquals('/', $generator->generate('app', ['controller' => 'home', 'action' => 'index']));
    }

    /**
     *
     */
    function test_merge()
    {
        $generator  = new Generator;

        $parent = new Definition([Arg::SCHEME => 'https', Arg::HOSTNAME => 'localhost', Arg::PORT => '443']);

        $child = $generator->merge($parent, new Definition);

        $this->assertTrue($parent == $child);

        $this->assertTrue($parent !== $child);

        $this->assertEquals('https', $child->scheme());

        $this->assertEquals('localhost', $child->hostname());

        $this->assertEquals('443', $child->port());
    }

    /**
     *
     */
    function test_name()
    {
        $definition = new Definition([Arg::NAME => 'app']);
        $generator  = new Generator($definition);

        $this->assertEquals('app', $generator->name('app'));
    }

    /**
     *
     */
    function test_name_not_exists()
    {
        $definition = new Definition([Arg::NAME => 'app']);

        $generator = new Generator($definition);

        $this->assertEquals('app/foo', $generator->name('foo'));
    }

    /**
     *
     */
    function test_options()
    {
        $generator = new Generator;

        $defaults = $generator->options();

        $options = [Arg::HOSTNAME => 'foo'];

        $this->assertEquals($options + $defaults, $generator->options($options));
    }

    /**
     *
     */
    function test_url()
    {
        $generator = new Generator([Arg::NAME => 'app']);

        $this->assertInstanceOf(Definition::class, $generator->url($this->definition));
    }

    /**
     *
     */
    function test_url_with_no_build()
    {
        $definition = new Definition($this->definition);
        $generator  = new Generator([Arg::NAME => 'app']);

        $this->assertEquals($definition, $generator->url($definition));
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

        $options = [Arg::SCHEME => 'https', Arg::HOSTNAME => 'localhost', Arg::PORT => '443', Arg::CANONICAL => true];

        $this->assertEquals('https://localhost/foo/bar', $generator('app', ['foo' => 'bar'], $options));
    }
}
