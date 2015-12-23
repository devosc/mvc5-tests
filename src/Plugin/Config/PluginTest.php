<?php
/**
 *
 */

namespace Mvc5\Test\Plugin\Config;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['args']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->args());
    }

    /**
     *
     */
    public function test_args_not_exist()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['args']);

        $mock->expects($this->once())
             ->method('offsetGet');

        $this->assertEquals([], $mock->args());
    }

    /**
     *
     */
    public function test_calls()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['calls']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->calls());
    }

    /**
     *
     */
    public function test_calls_not_exist()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['calls']);

        $mock->expects($this->once())
             ->method('offsetGet');

        $this->assertEquals([], $mock->calls());
    }

    /**
     *
     */
    public function test_merge()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['merge']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->merge());
    }

    /**
     *
     */
    public function test_merge_not_exist()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['merge']);

        $mock->expects($this->once())
             ->method('offsetGet');

        $this->assertEquals(false, $mock->merge());
    }

    /**
     *
     */
    public function test_name()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['name']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->name());
    }

    /**
     *
     */
    public function test_param()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['param']);

        $mock->expects($this->once())
            ->method('offsetGet')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->param());
    }

    /**
     *
     */
    public function test_param_not_exist()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMock(Plugin::class, ['param']);

        $mock->expects($this->once())
             ->method('offsetGet')
             ->willReturn('item');

        $this->assertEquals('item', $mock->param());
    }
}
