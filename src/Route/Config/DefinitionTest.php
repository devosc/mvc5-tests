<?php
/**
 *
 */

namespace Mvc5\Test\Route\Config;

use Mvc5\Arg;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class DefinitionTest
    extends TestCase
{
    /**
     *
     */
    public function test_add()
    {
        $definition = new Definition;

        $definition->add('bar', 'baz');

        $this->assertEquals('baz', $definition->child('bar'));
    }

    /**
     *
     */
    public function test_child_exists()
    {
        $definition = new Definition([Arg::CHILDREN => ['bar' => ['name' => 'baz']]]);

        $this->assertEquals(['name' => 'baz'], $definition->child('bar'));
    }

    /**
     *
     */
    public function test_child_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(null, $definition->child('bar'));
    }

    /**
     *
     */
    public function test_children_isset()
    {
        $definition = new Definition([Arg::CHILDREN => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->children());
    }

    /**
     *
     */
    public function test_children_not_isset()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->children());
    }

    /**
     *
     */
    public function test_className()
    {
        $definition = new Definition([Arg::CLASS_NAME => 'foo']);

        $this->assertEquals('foo', $definition->className());
    }

    /**
     *
     */
    public function test_constraints_exists()
    {
        $definition = new Definition([Arg::CONSTRAINTS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->constraints());
    }

    /**
     *
     */
    public function test_constraints_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->constraints());
    }

    /**
     *
     */
    public function test_controller()
    {
        $definition = new Definition([Arg::CONTROLLER => 'foo']);

        $this->assertEquals('foo', $definition->controller());
    }

    /**
     *
     */
    public function test_defaults_exists()
    {
        $definition = new Definition(['defaults' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->defaults());
    }

    /**
     *
     */
    public function test_defaults_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->defaults());
    }

    /**
     *
     */
    public function test_hostname_exists()
    {
        $definition = new Definition(['hostname' => 'foo']);

        $this->assertEquals('foo', $definition->hostname());
    }

    /**
     *
     */
    public function test_hostname_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(null, $definition->hostname());
    }

    /**
     *
     */
    public function test_name()
    {
        $definition = new Definition([Arg::NAME => 'foo']);

        $this->assertEquals('foo', $definition->name());
    }

    /**
     *
     */
    public function test_method_exists()
    {
        $definition = new Definition([Arg::METHOD => 'foo']);

        $this->assertEquals('foo', $definition->method());
    }

    /**
     *
     */
    public function test_method_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(null, $definition->method());
    }

    /**
     *
     */
    public function test_paramMap_exists()
    {
        $definition = new Definition([Arg::PARAM_MAP => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->paramMap());
    }

    /**
     *
     */
    public function test_paramMap_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->paramMap());
    }

    /**
     *
     */
    public function test_port_exists()
    {
        $definition = new Definition([Arg::PORT => '80']);

        $this->assertEquals('80', $definition->port());
    }

    /**
     *
     */
    public function test_port_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(null, $definition->port());
    }

    /**
     *
     */
    public function test_regex()
    {
        $definition = new Definition([Arg::REGEX => 'foo']);

        $this->assertEquals('foo', $definition->regex());
    }

    /**
     *
     */
    public function test_action()
    {
        $definition = new Definition([Arg::ACTION => ['GET' => 'foo']]);

        $this->assertEquals('foo', $definition->action('GET'));
    }

    /**
     *
     */
    public function test_actions()
    {
        $definition = new Definition([Arg::ACTION => ['GET' => 'foo']]);

        $this->assertEquals(['GET' => 'foo'], $definition->actions());
    }

    /**
     *
     */
    public function test_route()
    {
        $definition = new Definition([Arg::ROUTE => 'foo']);

        $this->assertEquals('foo', $definition->route());
    }

    /**
     *
     */
    public function test_scheme()
    {
        $definition = new Definition([Arg::SCHEME => 'foo']);

        $this->assertEquals('foo', $definition->scheme());
    }

    /**
     *
     */
    public function test_tokens_exists()
    {
        $definition = new Definition([Arg::TOKENS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->tokens());
    }

    /**
     *
     */
    public function test_tokens_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->tokens());
    }

    /**
     *
     */
    public function test_wildcard_exists()
    {
        $definition = new Definition([Arg::WILDCARD => 'foo']);

        $this->assertEquals('foo', $definition->wildcard());
    }

    /**
     *
     */
    public function test_wildcard_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(false, $definition->wildcard());
    }
}
