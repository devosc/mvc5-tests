<?php

namespace Mvc5\Test\View\Manager;

use Mvc5\View\Manager\ManageView;
use Mvc5\View\Manager\ViewManager;
use Mvc5\View\Model\ViewModel;
use Mvc5\Test\Test\TestCase;

class ManageViewTest
    extends TestCase
{
    /**
     *
     */
    public function test_call()
    {
        $mock = $this->getCleanMockForTrait(ManageView::class, ['call', 'setViewManager']);

        $vm = $this->getCleanMock(ViewManager::class);

        $vm->expects($this->once())
           ->method('call')
           ->willReturn('foo');

        $mock->setViewManager($vm);

        $this->assertEquals('foo', $mock->call('foo'));
    }

    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMockForTrait(ManageView::class, ['exception', 'setViewManager']);

        $vm = $this->getCleanMock(ViewManager::class);

        $vm->expects($this->once())
           ->method('exception')
           ->willReturn('foo');

        $mock->setViewManager($vm);

        $this->assertEquals('foo', $mock->exception(new \Exception));
    }

    /**
     *
     */
    public function test_plugin()
    {
        $mock = $this->getCleanMockForTrait(ManageView::class, ['plugin', 'setViewManager']);

        $vm = $this->getCleanMock(ViewManager::class);

        $vm->expects($this->once())
            ->method('plugin')
            ->willReturn('foo');

        $mock->setViewManager($vm);

        $this->assertEquals('foo', $mock->plugin('foo'));
    }

    /**
     *
     */
    public function test_render()
    {
        $mock = $this->getCleanMockForTrait(ManageView::class, ['render', 'setViewManager']);

        $vm = $this->getCleanMock(ViewManager::class);

        $vm->expects($this->once())
           ->method('render')
           ->willReturn('foo');

        $mock->setViewManager($vm);

        $model = $this->getCleanMock(ViewModel::class);

        $this->assertEquals('foo', $mock->render($model));
    }

    /**
     *
     */
    public function test_setViewManager()
    {
        $mock = $this->getCleanMockForTrait(ManageView::class, ['setViewManager']);

        $vm = $this->getCleanMock(ViewManager::class);

        $this->assertEquals(null, $mock->setViewManager($vm));
    }

    /**
     *
     */
    public function test_viewManager()
    {
        $mock = $this->getCleanMockForTrait(ManageView::class, ['viewManager']);

        $this->assertEquals(null, $mock->viewManager());
    }
}
