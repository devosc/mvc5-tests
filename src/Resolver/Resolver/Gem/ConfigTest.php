<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Config;
use Mvc5\Test\Resolver\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ConfigTest
    extends TestCase
{
    /**
     *
     */
    public function test_gem_config_link()
    {
        /** @var Resolver|Mock $mock */

        $mock = $this->getCleanAbstractMock(Resolver::class, ['gem', 'gemTest']);

        $mock->expects($this->once())
            ->method('config')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->gemTest(new Config()));
    }
}
