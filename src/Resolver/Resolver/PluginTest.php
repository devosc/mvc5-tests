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
    public function test_plugin_false()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $this->assertEquals(false, $mock->plugin(false));
    }

    /**
     *
     */
    public function test_plugin_string_build()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $mock->expects($this->any())
             ->method('build')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->plugin('foo.bar'));
    }

    /**
     *
     */
    public function test_plugin_array()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $this->assertEquals(false, $mock->plugin([false]));
    }

    /**
     *
     */
    public function test_plugin_closure()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $mock->expects($this->once())
             ->method('invoke')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->plugin(function() {}));
    }

    /**
     *
     */
    public function test_plugin_resolvable()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanMock(Resolver::class, ['plugin']);

        $mock->expects($this->once())
             ->method('resolve')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->plugin(new \stdClass));
    }
}
