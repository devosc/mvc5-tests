<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Plugin\Plugin;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ProvideTest
    extends TestCase
{
    /**
     *
     */
    public function test_provide()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['provide', 'provideTest']);

        $mock->expects($this->once())
            ->method('solve')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('configured')
            ->willReturn(new Plugin('foo'));

        $mock->expects($this->once())
            ->method('hydrate')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('build')
            ->willReturn(null);

        $config = new Plugin('foo', ['foo' => 'bar']);

        $this->assertEquals('foo', $mock->ProvideTest($config, ['foo' => 'baz']));
    }

    /**
     *
     */
    public function test_provide_no_parent_type_config()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['provide', 'provideTest']);

        $mock->expects($this->any())
            ->method('solve')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('configured')
            ->willReturn('bar');

        $mock->expects($this->once())
            ->method('hydrate')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('plugin')
            ->willReturn('bar');

        $config = new Plugin('foo');

        $this->assertEquals('foo', $mock->provideTest($config));
    }

    /**
     *
     */
    public function test_provide_with_merge()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['provide', 'provideTest']);

        $mock->expects($this->any())
            ->method('solve')
            ->willReturn('foo');

        $mock->expects($this->any())
            ->method('configured')
            ->will($this->onConsecutiveCalls(new Plugin('bar'), new \StdClass));

        $mock->expects($this->once())
            ->method('merge')
            ->willReturn(new Plugin('foo'));

        $mock->expects($this->once())
            ->method('hydrate')
            ->willReturn('foo');

        $mock->expects($this->once())
            ->method('plugin')
            ->willReturn('foo');

        $config = new Plugin('foo');

        $this->assertEquals('foo', $mock->provideTest($config));
    }
}
