<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Route\Definition\Base;
use Mvc5\Route\Definition\RouteDefinition;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test_add()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['add']);

        $this->assertEquals(null, $mock->add('bar', 'baz'));
    }

    /**
     *
     */
    public function test_child_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['child'], [['children' => ['bar' => ['name' => 'baz']]]]);

        $this->assertEquals(['name' => 'baz'], $mock->child('bar'));
    }

    /**
     *
     */
    public function test_child_not_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['child']);

        $this->assertEquals(null, $mock->child('bar'));
    }

    /**
     *
     */
    public function test_children()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['children']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->children());
    }

    /**
     *
     */
    public function test_className()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['className']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->className());
    }

    /**
     *
     */
    public function test_constraints_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['constraints']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->constraints());
    }

    /**
     *
     */
    public function test_constraints_not_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['constraints']);

        $this->assertEquals([], $mock->constraints());
    }

    /**
     *
     */
    public function test_controller()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['controller']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->controller());
    }

    /**
     *
     */
    public function test_defaults_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['defaults']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->defaults());
    }

    /**
     *
     */
    public function test_defaults_not_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['defaults']);

        $this->assertEquals([], $mock->defaults());
    }

    /**
     *
     */
    public function test_hostname_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['hostname']);

        $mock->expects($this->once())
            ->method('get')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->hostname());
    }

    /**
     *
     */
    public function test_hostname_not_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['hostname']);

        $this->assertEquals(null, $mock->hostname());
    }

    /**
     *
     */
    public function test_name()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['name']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->name());
    }

    /**
     *
     */
    public function test_method_exists()
    {
        $this->assertEquals('foo', (new RouteDefinition(['method' => 'foo']))->method());
    }

    /**
     *
     */
    public function test_method_not_exists()
    {
        $this->assertEquals(null, (new RouteDefinition)->method());
    }

    /**
     *
     */
    public function test_paramMap_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['paramMap']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->paramMap());
    }

    /**
     *
     */
    public function test_paramMap_not_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['paramMap']);

        $this->assertEquals([], $mock->paramMap());
    }

    /**
     *
     */
    public function test_regex()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['regex']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->regex());
    }

    /**
     *
     */
    public function test_route()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['route']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->route());
    }

    /**
     *
     */
    public function test_scheme()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['scheme']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->scheme());
    }

    /**
     *
     */
    public function test_tokens_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['tokens']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->tokens());
    }

    /**
     *
     */
    public function test_tokens_not_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['tokens']);

        $this->assertEquals([], $mock->tokens());
    }

    /**
     *
     */
    public function test_wildcard_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['wildcard']);

        $mock->expects($this->once())
             ->method('get')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->wildcard());
    }

    /**
     *
     */
    public function test_wildcard_not_exists()
    {
        $mock = $this->getCleanMockForTrait(Base::class, ['wildcard']);

        $this->assertEquals(false, $mock->wildcard());
    }
}
