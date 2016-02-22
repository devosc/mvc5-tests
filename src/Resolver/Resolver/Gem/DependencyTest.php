<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Args;
use Mvc5\Plugin\Dependency;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class DependencyTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_dependency_shared()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['gem', 'gemTest']);

        $mock->expects($this->once())
            ->method('shared')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->gemTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_gem_dependency_create()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['gem', 'gemTest']);

        $mock->expects($this->once())
            ->method('shared')
            ->willReturn(null);

        $mock->expects($this->once())
            ->method('initialize')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->gemTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_gem_dependency()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $this->assertEquals('test', $mock->gemTest(new Dependency('foo', new Args('test'))));
    }

    /**
     *
     */
    public function test_gem_dependency_not_null()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $value = 0;

        $this->assertTrue(false === $mock->has('foo'));

        $this->assertTrue($value === $mock->gemTest(new Dependency('foo', new Args($value))));

        $this->assertTrue(true === $mock->has('foo'));

        $this->assertTrue(['foo' => $value] === $mock->container());

        $this->assertTrue($value === $mock->gemTest(new Dependency('foo')));
    }

    /**
     *
     */
    public function test_gem_dependency_null()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getMockForAbstractClass(Resolver::class);

        $this->assertEquals(null, $mock->gemTest(new Dependency('foo', new Args(null))));
    }
}
