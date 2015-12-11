<?php

namespace Mvc5\Test\Route\Definition;

use Mvc5\Arg;
use Mvc5\Route\Definition;
use Mvc5\Route\Definition\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class BuildTest
    extends TestCase
{
    /**
     *
     */
    public function test_definition()
    {
        /** @var Build|Mock $mock */

        $mock = $this->getCleanMock(Build::class, ['definition', 'definitionTest']);

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
            Arg::CHILDREN    => [[]],
            Arg::CONSTRAINTS => null,
            Arg::NAME        => null,
            Arg::PARAM_MAP   => null,
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $result = [
            Arg::CHILDREN    => [['foo']],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => 'foo',
            Arg::ROUTE       => '/',
            Arg::TOKENS      => []
        ];

        $this->assertEquals($result, $mock->definitionTest($definition, true, true));
    }

    /**
     *
     */
    public function test_definition_no_route_exception()
    {
        /** @var Build|Mock $mock */

        $mock = $this->getCleanMock(Build::class, ['definition', 'definitionTest']);

        $this->setExpectedException('RuntimeException');

        $mock->definitionTest([]);
    }

    /**
     *
     */
    public function test_children()
    {
        /** @var Build|Mock $mock */

        $mock = $this->getCleanMock(Build::class, ['children', 'childrenTest']);

        $definitions = [
            [
                Arg::CHILDREN    => [],
                Arg::CONSTRAINTS => [],
                Arg::NAME        => null,
                Arg::PARAM_MAP   => [],
                Arg::REGEX       => null,
                Arg::ROUTE       => '/',
                Arg::TOKENS      => null
            ]
        ];

        $this->assertInternalType('array', $mock->childrenTest($definitions));
    }

    /**
     *
     */
    public function test_create_route_definition()
    {
        /** @var Build|Mock $mock */

        $mock = $this->getCleanMock(Build::class, ['create', 'createTest']);

        $definition = new Config([
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ]);

        $this->assertInstanceOf(Config::class, $mock->createTest($definition));
    }

    /**
     *
     */
    public function test_create_with_class_name()
    {
        /** @var Build|Mock $mock */

        $mock = $this->getCleanMock(Build::class, ['create', 'createTest']);

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CLASS_NAME  => Config::class,
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Config::class, $mock->createTest($definition));
    }

    /**
     *
     */
    public function test_create()
    {
        /** @var Build|Mock $mock */

        $mock = $this->getCleanMock(Build::class, ['create', 'createTest']);

        $definition = [
            Arg::CHILDREN    => [],
            Arg::CONSTRAINTS => [],
            Arg::NAME        => null,
            Arg::PARAM_MAP   => [],
            Arg::REGEX       => null,
            Arg::ROUTE       => '/',
            Arg::TOKENS      => null
        ];

        $this->assertInstanceOf(Config::class, $mock->createTest($definition));
    }

    /**
     *
     */
    public function test_build()
    {
        /** @var Build|Mock $mock */

        $mock = $this->getCleanMock(Build::class, ['build', 'buildTest']);

        $mock->expects($this->once())
            ->method('definition')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('create')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->buildTest([]));
    }
}
