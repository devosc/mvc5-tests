<?php

namespace Mvc5\Test\View;

use Mvc5\View\ViewPlugin;
use Mvc5\Test\Test\TestCase;

class ViewPluginTest
    extends TestCase
{
    /**
     *
     */
    public function test__call()
    {
        $mock = $this->getCleanMockForTrait(ViewPlugin::class, ['__call']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__call('bar'));
    }
}
