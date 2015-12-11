<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Arg;
use Mvc5\Route\Definition;
use Mvc5\Route\Definition\Add;
use Mvc5\Route\Definition\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class AddTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        /** @var Add|Mock $mock */

        $mock = $this->getCleanMock(Add::class, ['__invoke']);

        $definition = $this->getCleanMock(Definition::class);

        $mock->expects($this->once())
             ->method('definition')
             ->willReturn($definition);

        /** @var Definition|Mock $parent */

        $parent = $this->getCleanMock(Definition::class);

        $parent->expects($this->once())
               ->method('child')
               ->willReturn(null);

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ];

        $path = ['/'];

        $this->assertInstanceOf(Definition::class, $mock->__invoke($parent, $definition, $path));
    }

    /**
     *
     */
    public function test_invoke_start()
    {
        /** @var Add|Mock $mock */

        $mock = $this->getCleanMock(Add::class, ['__invoke']);

        $definition = $this->getCleanMock(Definition::class);

        $mock->expects($this->once())
            ->method('definition')
            ->willReturn($definition);

        /** @var Definition|Mock $parent */

        $parent = $this->getCleanMock(Definition::class);

        $parent->expects($this->once())
               ->method('child')
               ->willReturn(null);

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => 'foo',
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ];

        $path = ['/'];

        $this->assertInstanceOf(Definition::class, $mock->__invoke($parent, $definition, $path, true));
    }

    /**
     *
     */
    public function test_invoke_no_parent()
    {
        /** @var Add|Mock $mock */

        $mock = $this->getCleanMock(Add::class, ['__invoke']);

        /** @var Definition|Mock $parent */

        $parent = $this->getCleanMock(Definition::class);

        $parent->expects($this->once())
               ->method('child')
               ->willReturn(null);

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ];

        $path = ['/', 'foo'];

        $this->setExpectedException('RuntimeException');

        $this->assertInstanceOf(Definition::class, $mock->__invoke($parent, $definition, $path));
    }

    /**
     *
     */
    public function test_invoke_with_root()
    {
        /** @var Add|Mock $mock */

        $mock = $this->getCleanMock(Add::class, ['__invoke']);

        $root = $this->getCleanMock(Definition::class);

        $root->expects($this->once())
             ->method('add');

        /** @var Definition|Mock $parent */

        $parent = $this->getCleanMock(Definition::class);

        $parent->expects($this->once())
               ->method('child')
               ->willReturn($root);

        $definition = new Config([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => null,
            Arg::TOKENS      => null
        ]);

        $path = ['bar', 'baz'];

        $mock->expects($this->once())
             ->method('definition')
             ->willReturn($definition);

        $this->assertInstanceOf(Definition::class, $mock->__invoke($parent, $definition, $path));
    }
}
