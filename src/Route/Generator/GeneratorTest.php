<?php

namespace Mvc5\Test\Route\Generator;

use Mvc5\Route\Definition\RouteDefinition;
use Mvc5\Test\Test\TestCase;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    public function test_build()
    {
        $definition = $this->getCleanMock(RouteDefinition::class);

        $definition->expects($this->once())
                   ->method('tokens')
                   ->willReturn([]);

        $definition->expects($this->once())
                   ->method('defaults')
                   ->willReturn([]);

        $definition->expects($this->once())
                   ->method('wildcard')
                   ->willReturn(true);

        $definition->expects($this->once())
                   ->method('constraints')
                   ->willReturn([]);

        $mock = $this->getCleanMock(Generator::class, ['build', 'testBuild']);

        $mock->expects($this->once())
             ->method('create')
             ->willReturn($definition);

        $mock->expects($this->once())
             ->method('config');

        $args = ['foo' => 'bar'];

        $this->assertEquals('/foo/bar', $mock->testBuild('foo', $args));
    }

    /**
     *
     */
    public function test_build_no_definition_exception()
    {
        $mock = $this->getCleanMock(Generator::class, ['build', 'testBuild']);

        $mock->expects($this->once())
            ->method('create');

        $mock->expects($this->once())
            ->method('config');

        $args = ['foo' => 'bar'];

        $this->setExpectedException('Exception');

        $mock->testBuild('foo', $args);
    }

    /**
     *
     */
    public function test_build_with_child()
    {
        $definition = $this->getCleanMock(RouteDefinition::class);

        $definition->expects($this->once())
                   ->method('tokens')
                   ->willReturn([]);

        $definition->expects($this->once())
                   ->method('defaults')
                   ->willReturn([]);

        $definition->expects($this->once())
                   ->method('wildcard')
                   ->willReturn(true);

        $definition->expects($this->once())
                   ->method('constraints')
                   ->willReturn([]);

        $definition->expects($this->once())
                   ->method('child');

        $mock = $this->getCleanMock(Generator::class, ['build', 'testBuild']);

        $mock->expects($this->once())
             ->method('create')
             ->willReturn($definition);

        $mock->expects($this->any())
             ->method('config');

        $args = ['foo' => 'bar'];

        $this->assertEquals('/foo/bar', $mock->testBuild('foo', $args, $definition));
    }

    /**
     *
     */
    public function test_config_exists()
    {
        $definition = new RouteDefinition(['name' => 'bar']);

        $mock = $this->getCleanMock(Generator::class, ['config', 'testConfig'], [$definition]);

        $this->assertEquals($definition, $mock->testConfig('bar'));
    }

    /**
     *
     */
    public function test_config_not_exists()
    {
        $definition = $this->getCleanMock(RouteDefinition::class);

        $definition->expects($this->once())
                   ->method('child')
                   ->willReturn('foo');

        $mock = $this->getCleanMock(Generator::class, ['config', 'testConfig'], [$definition]);

        $this->assertEquals('foo', $mock->testConfig('bar'));
    }

    /**
     *
     */
    public function test_create()
    {
        $definition = new RouteDefinition(['regex' => 'foo']);

        $mock = $this->getCleanMock(Generator::class, ['create', 'testCreate']);

        $this->assertEquals($definition, $mock->testCreate($definition));
    }

    /**
     *
     */
    public function test_name()
    {
        $definition = new RouteDefinition(['name' => 'foo']);

        $mock = $this->getCleanMock(Generator::class, ['name', 'testName'], [$definition]);

        $this->assertEquals('foo', $mock->testName('foo'));
    }

    /**
     *
     */
    public function test_name_not_exists()
    {
        $definition = new RouteDefinition(['name' => 'foo']);

        $mock = $this->getCleanMock(Generator::class, ['name', 'testName'], [$definition]);

        $this->assertEquals('foo/bar', $mock->testName('bar'));
    }

    /**
     *
     */
    public function test_url()
    {
        $definition = new RouteDefinition(['name' => 'foo']);

        $mock = $this->getCleanMock(Generator::class, ['url'], [$definition]);

        $mock->expects($this->once())
             ->method('build')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->url('foo'));
    }

    /**
     *
     */
    public function test_url_with_no_build()
    {
        $definition = new RouteDefinition(['name' => 'foo']);

        $mock = $this->getCleanMock(Generator::class, ['url'], [$definition]);

        $mock->expects($this->once())
             ->method('build')
             ->willReturn('');

        $this->assertEquals('/', $mock->url(''));
    }
}
