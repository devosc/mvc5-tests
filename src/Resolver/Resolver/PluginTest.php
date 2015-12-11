<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->plugin('foo'));
    }

    /**
     *
     */
    public function test_plugin_service()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $mock->expects($this->once())
            ->method('resolve')
            ->willReturn(null);

        $mock->expects($this->once())
            ->method('create')
            ->willReturn('bar');

        $this->assertEquals('bar', $mock->plugin('foo'));
    }
}
