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
    public function test_construct()
    {
        $this->assertInstanceOf(Generator::class, new Generator([]));
    }

    /**
     *
     */
    public function test_config()
    {
        $definition = new Definition([Arg::NAME => 'app']);
        $generator  = new Generator($definition);

        $this->assertEquals($definition, $generator->config('app'));
    }

    /**
     *
     */
    public function test_config_child()
    {
        $definition = new Definition([Arg::NAME => 'app', Arg::CHILDREN => ['foo' => 'bar']]);
        $generator  = new Generator($definition);

        $this->assertEquals('bar', $generator->config('foo'));
    }

    /**
     *
     */
    public function test_name()
    {
        $definition = new Definition([Arg::NAME => 'app']);
        $generator  = new Generator($definition);

        $this->assertEquals('app', $generator->name('app'));
    }

    /**
     *
     */
    public function test_name_not_exists()
    {
        $definition = new Definition([Arg::NAME => 'app']);

        $generator = new Generator($definition);

        $this->assertEquals('app/foo', $generator->name('foo'));
    }

    /**
     *
     */
    public function test_url()
    {
        $generator = new Generator([Arg::NAME => 'app']);

        $this->assertInstanceOf(Definition::class, $generator->url($this->definition));
    }

    /**
     *
     */
    public function test_url_with_no_build()
    {
        $definition = new Definition($this->definition);
        $generator  = new Generator([Arg::NAME => 'app']);

        $this->assertEquals($definition, $generator->url($definition));
    }

    /**
     * @fixme remove double slash
     */
    public function test_generate()
    {
        $generator = new Generator(new Definition($this->definition));

        $this->assertEquals('//foo/bar', $generator->generate('app', ['foo' => 'bar']));
    }

    /**
     * @fixme where is the leading slash?
     */
    public function test_generate_with_child()
    {
        $definition = [
            Arg::NAME     => 'app',
            Arg::ROUTE    => '/',
            Arg::CHILDREN => [
                'foo' => [
                    Arg::ROUTE => 'foo/:controller'
                ]
            ]
        ];

        $generator = new Generator(new Definition([Arg::NAME => 'app']));

        $args = ['controller' => 'bar'];

        $this->assertEquals('foo/bar', $generator->generate('foo', $args, new Definition($definition)));
    }

    /**
     *
     */
    public function test_generate_wildcard()
    {
        $generator = new Generator(new Definition($this->definition));

        $this->assertEquals('/foo/bar', $generator->generate('app', ['controller' => 'foo', 'action' => 'bar']));
    }

    /**
     *
     */
    public function test_generate_wildcard_defaults()
    {
        $generator = new Generator(new Definition($this->definition));

        $this->assertEquals('/', $generator->generate('app', ['controller' => 'home', 'action' => 'index']));
    }

    /**
     *
     */
    public function test_invoke()
    {
        $generator = new Generator([Arg::NAME => 'app', Arg::ROUTE => '/foo']);

        $this->assertEquals('/foo', $generator('app'));
    }

    /**
     *
     */
    public function test_invoke_no_path()
    {
        $generator = new Generator([Arg::NAME => 'app', Arg::ROUTE => '/']);

        $this->assertEquals('/', $generator('app'));
    }
}
