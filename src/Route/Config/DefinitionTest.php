<?php
/**
 *
 */

namespace Mvc5\Test\Route\Config;

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

        $mock = $this->getCleanMock(Definition::class, ['child'], [['children' => ['bar' => ['name' => 'baz']]]]);

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
    public function test_children()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['children']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->children());
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
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['constraints']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->constraints());
    }

    /**
     *
     */
    public function test_constraints_not_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['constraints']);

        $this->assertEquals([], $mock->constraints());
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
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['defaults']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->defaults());
    }

    /**
     *
     */
    public function test_defaults_not_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['defaults']);

        $this->assertEquals([], $mock->defaults());
    }

    /**
     *
     */
    public function test_hostname_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['hostname']);

        $mock->expects($this->once())
            ->method('offsetGet')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->hostname());
    }

    /**
     *
     */
    public function test_hostname_not_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['hostname']);

        $this->assertEquals(null, $mock->hostname());
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
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['paramMap']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->paramMap());
    }

    /**
     *
     */
    public function test_paramMap_not_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['paramMap']);

        $this->assertEquals([], $mock->paramMap());
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
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['tokens']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->tokens());
    }

    /**
     *
     */
    public function test_tokens_not_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['tokens']);

        $this->assertEquals([], $mock->tokens());
    }

    /**
     *
     */
    public function test_wildcard_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['wildcard']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->wildcard());
    }

    /**
     *
     */
    public function test_wildcard_not_exists()
    {
        /** @var Definition|Mock $mock */

        $mock = $this->getCleanMock(Definition::class, ['wildcard']);

        $this->assertEquals(false, $mock->wildcard());
    }
}
