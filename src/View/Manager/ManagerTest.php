<?php

namespace Mvc5\Test\View\Manager;

use Mvc5\View\Manager\Manager;
use Mvc5\View\Model\ViewModel;
use Mvc5\Test\Test\TestCase;

class ManagerTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMock(Manager::class, ['exception']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->exception(new \Exception));
    }

    /**
     *
     */
    public function test_render()
    {
        $mock = $this->getCleanMock(Manager::class, ['render']);

        $mock->expects($this->once())
            ->method('trigger')
            ->willReturn('foo');

        $model = $this->getCleanMock(ViewModel::class);

        $this->assertEquals('foo', $mock->render($model));
    }
}
