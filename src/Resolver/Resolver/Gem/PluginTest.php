<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Plugin;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_plugin()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['gem', 'gemTest']);

        $mock->expects($this->once())
            ->method('provide')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->gemTest(new Plugin(null)));
    }
}
