<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\View as MvcView;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ViewTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        /** @var MvcView|Mock $mock */

        $mock = $this->getCleanMock(MvcView::class, ['__invoke']);

        $mock->expects($this->once())
            ->method('render')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(null));
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        /** @var MvcView|Mock $mock */

        $mock = $this->getCleanMock(MvcView::class, ['__invoke']);

        $mock->expects($this->once())
            ->method('render')
            ->will($this->throwException(new \Exception));

        $mock->expects($this->once())
            ->method('exception')
            ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(null));
    }
}
