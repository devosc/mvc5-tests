<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        /** @var Renderer|Mock $mock */

        $mock = $this->getCleanAbstractMock(Renderer::class, ['exception', 'exceptionTest']);

        $mock->expects($this->once())
             ->method('call')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->exceptionTest(new \Exception, null));
    }

    /**
     *
     */
    public function test_render()
    {
        /** @var Renderer|Mock $mock */

        $mock = $this->getCleanMock(Renderer::class, ['render', 'renderTest']);

        $mock->expects($this->once())
            ->method('call')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->renderTest(null));
    }
}
