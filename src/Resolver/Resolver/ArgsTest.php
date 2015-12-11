<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Config;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ArgsTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'argsTest']);

        $this->assertEquals(false, $mock->argsTest(false));
    }

    /**
     *
     */
    public function test_args_not_array()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'argsTest']);

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->argsTest('foo'));
    }

    /**
     *
     */
    public function test_args_array()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['args', 'argsTest']);

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('bar');

        $this->assertEquals(['foo' => 'bar'], $mock->argsTest(['foo' => new Config]));
    }
}
