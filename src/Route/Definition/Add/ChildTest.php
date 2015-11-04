<?php

namespace Mvc5\Test\Route\Add;

use Mvc5\Route\Definition\Add\Child;
use Mvc5\Route\Definition\Definition;
use Mvc5\Route\Definition\RouteDefinition;
use Mvc5\Test\Test\TestCase;

class ChildTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Child::class, ['__invoke']);

        $definition = $this->getCleanMock(RouteDefinition::class);

        $mock->expects($this->once())
             ->method('definition')
             ->willReturn($definition);

        $parent = $this->getCleanMock(Definition::class);

        $parent->expects($this->once())
               ->method('child')
               ->willReturn(null);

        $definition = [
            Definition::CHILDREN    => [],
            Definition::CONSTRAINTS => [],
            Definition::NAME        => null,
            Definition::PARAM_MAP   => [],
            Definition::REGEX       => null,
            Definition::ROUTE       => null,
            Definition::TOKENS      => null
        ];

        $path = ['/'];

        $this->assertInstanceOf(Definition::class, $mock->__invoke($parent, $definition, $path));
    }

    /**
     *
     */
    public function test__invoke_no_parent()
    {
        $mock = $this->getCleanMock(Child::class, ['__invoke']);

        $parent = $this->getCleanMock(Definition::class);

        $parent->expects($this->once())
               ->method('child')
               ->willReturn(null);

        $definition = [
            Definition::CHILDREN    => [],
            Definition::CONSTRAINTS => [],
            Definition::NAME        => null,
            Definition::PARAM_MAP   => [],
            Definition::REGEX       => null,
            Definition::ROUTE       => null,
            Definition::TOKENS      => null
        ];

        $path = ['/', 'foo'];

        $this->setExpectedException('RuntimeException');

        $this->assertInstanceOf(Definition::class, $mock->__invoke($parent, $definition, $path));
    }

    /**
     *
     */
    public function test__invoke_with_root()
    {
        $mock = $this->getCleanMock(Child::class, ['__invoke']);

        $root = $this->getCleanMock(Definition::class);

        $root->expects($this->once())
             ->method('add');

        $parent = $this->getCleanMock(Definition::class);

        $parent->expects($this->once())
               ->method('child')
               ->willReturn($root);

        $definition = new RouteDefinition([
            Definition::CHILDREN    => [],
            Definition::CONSTRAINTS => [],
            Definition::NAME        => null,
            Definition::PARAM_MAP   => [],
            Definition::REGEX       => null,
            Definition::ROUTE       => null,
            Definition::TOKENS      => null
        ]);

        $path = ['bar', 'baz'];

        $mock->expects($this->once())
             ->method('definition')
             ->willReturn($definition);

        $this->assertInstanceOf(Definition::class, $mock->__invoke($parent, $definition, $path));
    }
}
