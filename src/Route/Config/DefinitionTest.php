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
    function test_add()
    {
        $definition = new Definition;

        $definition->add('bar', 'baz');

        $this->assertEquals('baz', $definition->child('bar'));
    }

    /**
     *
     */
    function test_child_exists()
    {
        $definition = new Definition([Arg::CHILDREN => ['bar' => ['name' => 'baz']]]);

        $this->assertEquals(['name' => 'baz'], $definition->child('bar'));
    }

    /**
     *
     */
    function test_child_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(null, $definition->child('bar'));
    }

    /**
     *
     */
    function test_children_isset()
    {
        $definition = new Definition([Arg::CHILDREN => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->children());
    }

    /**
     *
     */
    function test_children_not_isset()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->children());
    }

    /**
     *
     */
    function test_className()
    {
        $definition = new Definition([Arg::CLASS_NAME => 'foo']);

        $this->assertEquals('foo', $definition->className());
    }

    /**
     *
     */
    function test_constraints_exists()
    {
        $definition = new Definition([Arg::CONSTRAINTS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->constraints());
    }

    /**
     *
     */
    function test_constraints_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->constraints());
    }

    /**
     *
     */
    function test_controller()
    {
        $definition = new Definition([Arg::CONTROLLER => 'foo']);

        $this->assertEquals('foo', $definition->controller());
    }

    /**
     *
     */
    function test_defaults_exists()
    {
        $definition = new Definition(['defaults' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->defaults());
    }

    /**
     *
     */
    function test_defaults_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->defaults());
    }

    /**
     *
     */
    function test_hostname_exists()
    {
        $definition = new Definition(['hostname' => 'foo']);

        $this->assertEquals('foo', $definition->hostname());
    }

    /**
     *
     */
    function test_hostname_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(null, $definition->hostname());
    }

    /**
     *
     */
    function test_name()
    {
        $definition = new Definition([Arg::NAME => 'foo']);

        $this->assertEquals('foo', $definition->name());
    }

    /**
     *
     */
    function test_method_exists()
    {
        $definition = new Definition([Arg::METHOD => 'foo']);

        $this->assertEquals('foo', $definition->method());
    }

    /**
     *
     */
    function test_method_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(null, $definition->method());
    }

    /**
     *
     */
    function test_paramMap_exists()
    {
        $definition = new Definition([Arg::PARAM_MAP => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->paramMap());
    }

    /**
     *
     */
    function test_paramMap_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->paramMap());
    }

    /**
     *
     */
    function test_port_exists()
    {
        $definition = new Definition([Arg::PORT => '80']);

        $this->assertEquals('80', $definition->port());
    }

    /**
     *
     */
    function test_port_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(null, $definition->port());
    }

    /**
     *
     */
    function test_regex()
    {
        $definition = new Definition([Arg::REGEX => 'foo']);

        $this->assertEquals('foo', $definition->regex());
    }

    /**
     *
     */
    function test_action()
    {
        $definition = new Definition([Arg::ACTION => ['GET' => 'foo']]);

        $this->assertEquals('foo', $definition->action('GET'));
    }

    /**
     *
     */
    function test_actions()
    {
        $definition = new Definition([Arg::ACTION => ['GET' => 'foo']]);

        $this->assertEquals(['GET' => 'foo'], $definition->actions());
    }

    /**
     *
     */
    function test_route()
    {
        $definition = new Definition([Arg::ROUTE => 'foo']);

        $this->assertEquals('foo', $definition->route());
    }

    /**
     *
     */
    function test_scheme()
    {
        $definition = new Definition([Arg::SCHEME => 'foo']);

        $this->assertEquals('foo', $definition->scheme());
    }

    /**
     *
     */
    function test_tokens_exists()
    {
        $definition = new Definition([Arg::TOKENS => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->tokens());
    }

    /**
     *
     */
    function test_tokens_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals([], $definition->tokens());
    }

    /**
     *
     */
    function test_wildcard_exists()
    {
        $definition = new Definition([Arg::WILDCARD => 'foo']);

        $this->assertEquals('foo', $definition->wildcard());
    }

    /**
     *
     */
    function test_wildcard_not_exists()
    {
        $definition = new Definition;

        $this->assertEquals(false, $definition->wildcard());
    }
}
