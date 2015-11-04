<?php

namespace Mvc5\Test\Route\Definition\Build;

use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Definition\RouteDefinition;
use Mvc5\Test\Test\TestCase;

class BaseTest
    extends TestCase
{
    /**
     *
     */
    public function test_build()
    {
        $mock = $this->getCleanMock(Base::class, ['build', 'testBuild']);

        $mock->expects($this->once())
             ->method('tokens')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('regex')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('params')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('children')
             ->willReturn([['foo']]);

        $definition = [
            Definition::CHILDREN    => [[]],
            Definition::CONSTRAINTS => null,
            Definition::NAME        => null,
            Definition::PARAM_MAP   => null,
            Definition::REGEX       => null,
            Definition::ROUTE       => '/',
            Definition::TOKENS      => null
        ];

        $result = [
            Definition::CHILDREN    => [['foo']],
            Definition::CONSTRAINTS => [],
            Definition::NAME        => null,
            Definition::PARAM_MAP   => [],
            Definition::REGEX       => 'foo',
            Definition::ROUTE       => '/',
            Definition::TOKENS      => []
        ];

        $this->assertEquals($result, $mock->testBuild($definition, true, true));
    }

    /**
     *
     */
    public function test_build_no_route_exception()
    {
        $mock = $this->getCleanMock(Base::class, ['build', 'testBuild']);

        $this->setExpectedException('RuntimeException');

        $mock->testBuild([]);
    }

    /**
     *
     */
    public function test_children()
    {
        $mock = $this->getCleanMock(Base::class, ['children', 'testChildren']);

        $definitions = [
            [
                Definition::CHILDREN    => [],
                Definition::CONSTRAINTS => [],
                Definition::NAME        => null,
                Definition::PARAM_MAP   => [],
                Definition::REGEX       => null,
                Definition::ROUTE       => '/',
                Definition::TOKENS      => null
            ]
        ];

        $this->assertInternalType('array', $mock->testChildren($definitions));
    }

    /**
     *
     */
    public function test_create_route_definition()
    {
        $mock = $this->getCleanMock(Base::class, ['create', 'testCreate']);

        $definition = new RouteDefinition([
            Definition::CHILDREN    => [],
            Definition::CONSTRAINTS => [],
            Definition::NAME        => null,
            Definition::PARAM_MAP   => [],
            Definition::REGEX       => null,
            Definition::ROUTE       => '/',
            Definition::TOKENS      => null
        ]);

        $this->assertInstanceOf(Definition::class, $mock->testCreate($definition));
    }

    /**
     *
     */
    public function test_create_with_class_name()
    {
        $mock = $this->getCleanMock(Base::class, ['create', 'testCreate']);

        $definition = [
            Definition::CHILDREN    => [],
            Definition::CLASS_NAME  => RouteDefinition::class,
            Definition::CONSTRAINTS => [],
            Definition::NAME        => null,
            Definition::PARAM_MAP   => [],
            Definition::REGEX       => null,
            Definition::ROUTE       => '/',
            Definition::TOKENS      => null
        ];

        $this->assertInstanceOf(Definition::class, $mock->testCreate($definition));
    }

    /**
     *
     */
    public function test_create()
    {
        $mock = $this->getCleanMock(Base::class, ['create', 'testCreate']);

        $definition = [
            Definition::CHILDREN    => [],
            Definition::CONSTRAINTS => [],
            Definition::NAME        => null,
            Definition::PARAM_MAP   => [],
            Definition::REGEX       => null,
            Definition::ROUTE       => '/',
            Definition::TOKENS      => null
        ];

        $this->assertInstanceOf(Definition::class, $mock->testCreate($definition));
    }

    /**
     *
     */
    public function test_definition()
    {
        $mock = $this->getCleanMock(Base::class, ['definition', 'testDefinition']);

        $mock->expects($this->once())
             ->method('build')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('create')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->testDefinition([]));
    }
}
