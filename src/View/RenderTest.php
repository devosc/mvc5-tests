<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Test\Test\TestCase;
use Mvc5\View\Render;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RenderTest
    extends TestCase
{

    /**
     *
     */
    public function test_invoke()
    {
        /** @var Render|Mock $mock */

        $mock = $this->getCleanMock(Render::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $mock->expects($this->once())
             ->method('stop');

        $this->assertEquals('foo', $mock->__invoke(function(){}));
    }
}
