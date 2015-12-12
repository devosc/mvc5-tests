<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\Model\Template\Plugin;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class PluginTest
    extends TestCase
{
    /**
     *
     */
    public function test_call()
    {
        /** @var Plugin|Mock $mock */

        $mock = $this->getCleanMockForTrait(Plugin::class, ['__call']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__call(null));
    }
}
