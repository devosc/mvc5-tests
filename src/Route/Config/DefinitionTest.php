<?php
/**
 *
 */

namespace Mvc5\Test\Route\Config;

use Mvc5\Arg;
use Mvc5\Route\Definition\Config as RouteDefinition;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DefinitionTest
    extends TestCase
{
    /**
     *
     */
    public function test_add()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['add']);

        $mock->add('bar', 'baz');
    }

    /**
     *
     */
    public function test_child_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['child', 'get', 'offsetGet'], [['children' => ['bar' => ['name' => 'baz']]]]);

        $this->assertEquals(['name' => 'baz'], $mock->child('bar'));
    }

    /**
     *
     */
    public function test_child_not_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['child']);

        $this->assertEquals(null, $mock->child('bar'));
    }

    /**
     *
     */
    public function test_children_isset()
    {
        $definition = new Definition(['children' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->children());
    }

    /**
     *
     */
    public function test_children_not_isset()
    {
        $definition = new Definition();

        $this->assertEquals([], $definition->children());
    }

    /**
     *
     */
    public function test_className()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['className']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->className());
    }

    /**
     *
     */
    public function test_constraints_exists()
    {
        $definition = new Definition(['constraints' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->constraints());
    }

    /**
     *
     */
    public function test_constraints_not_exists()
    {
        /** @var Definition|Mock $mock */

        $definition = new Definition();

        $this->assertEquals([], $definition->constraints());
    }

    /**
     *
     */
    public function test_controller()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['controller']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->controller());
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
        $definition = new Definition();

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
        $definition = new Definition();

        $this->assertEquals(null, $definition->hostname());
    }

    /**
     *
     */
    public function test_name()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['name']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->name());
    }

    /**
     *
     */
    public function test_method_exists()
    {
        /** @var Definition|Mock $mock */

        $this->assertEquals('foo', (new RouteDefinition(['method' => 'foo']))->method());
    }

    /**
     *
     */
    public function test_method_not_exists()
    {
        /** @var Definition|Mock $mock */

        $this->assertEquals(null, (new RouteDefinition)->method());
    }

    /**
     *
     */
    public function test_paramMap_exists()
    {
        $definition = new Definition(['paramMap' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->paramMap());
    }

    /**
     *
     */
    public function test_paramMap_not_exists()
    {
        $definition = new Definition();

        $this->assertEquals([], $definition->paramMap());
    }

    /**
     *
     */
    public function test_regex()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['regex']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->regex());
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
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['route']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->route());
    }

    /**
     *
     */
    public function test_scheme()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['scheme']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->scheme());
    }

    /**
     *
     */
    public function test_tokens_exists()
    {
        $definition = new Definition(['tokens' => ['foo' => 'bar']]);

        $this->assertEquals(['foo' => 'bar'], $definition->tokens());
    }

    /**
     *
     */
    public function test_tokens_not_exists()
    {
        $definition = new Definition();

        $this->assertEquals([], $definition->tokens());
    }

    /**
     *
     */
    public function test_wildcard_exists()
    {
        $definition = new Definition(['wildcard' => 'foo']);

        $this->assertEquals('foo', $definition->wildcard());
    }

    /**
     *
     */
    public function test_wildcard_not_exists()
    {
        /** @var Definition|Mock $mock */

        $definition = new Definition();;

        $this->assertEquals(false, $definition->wildcard());
    }
}
