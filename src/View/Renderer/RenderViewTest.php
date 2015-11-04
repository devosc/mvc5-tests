<?php

namespace Mvc5\Test\View\Renderer;

use Mvc5\View\Manager\ViewManager;
use Mvc5\View\Model\Model;
use Mvc5\View\Renderer\RenderView;
use Mvc5\Test\Test\TestCase;

class RenderViewTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMockForTrait(RenderView::class, ['__invoke']);

        $template = __DIR__ . '/index.phtml';

        $config = [Model::CHILD => new Model($template)];

        $model = $this->getCleanMock(Model::class, ['current', 'key', 'next', 'valid'], [$template, $config]);

        $model->expects($this->once())
              ->method('set');

        $model->expects($this->once())
              ->method('template');

        $model->expects($this->once())
              ->method('setViewManager');

        $model->expects($this->once())
              ->method('assigned')
              ->willReturn([]);

        $model->expects($this->any())
              ->method('path')
              ->willReturn($template);

        $vm = $this->getCleanMock(ViewManager::class);

        $mock->expects($this->any())
             ->method('viewManager')
             ->willReturn($vm);

        $mock->expects($this->any())
             ->method('template')
             ->willReturn($template);

        $this->assertEquals('<h1>Home</h1>', trim($mock->__invoke($model)));
    }

    /**
     *
     */
    public function test_invoke_no_template_exception()
    {
        $mock = $this->getCleanMockForTrait(RenderView::class, ['__invoke']);

        $model = $this->getCleanMock(Model::class, ['current', 'key', 'next', 'valid']);

        $model->expects($this->any())
              ->method('path');

        $this->setExpectedException('RuntimeException');

        $mock->__invoke($model);
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        $mock = $this->getCleanMockForTrait(RenderView::class, ['__invoke']);

        $template = __DIR__ . '/exception.phtml';

        $model = $this->getCleanMock(Model::class, ['current', 'key', 'next', 'valid'], [$template]);

        $model->expects($this->once())
              ->method('template');

        $model->expects($this->once())
              ->method('setViewManager');

        $model->expects($this->once())
              ->method('assigned')
              ->willReturn([]);

        $model->expects($this->any())
              ->method('path')
              ->willReturn($template);

        $vm = $this->getCleanMock(ViewManager::class);

        $mock->expects($this->any())
             ->method('viewManager')
             ->willReturn($vm);

        $mock->expects($this->any())
             ->method('template')
             ->willReturn($template);

        $this->setExpectedException('Exception');

        $mock->__invoke($model);
    }
}
