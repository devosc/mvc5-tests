<?php

namespace Mvc5\Test\Mvc\Layout;

use Mvc5\Mvc\Layout\Renderer;
use Mvc5\View\Layout\Model as LayoutModel;
use Mvc5\View\Model\Model;
use Mvc5\Test\Test\TestCase;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke_with_no_model()
    {
        $layout = $this->getCleanMock(LayoutModel::class);

        $this->assertEquals(null, (new Renderer)->__invoke($layout));
    }

    /**
     *
     */
    public function test_invoke_with_not_a_view_model()
    {
        $layout = $this->getCleanMock(LayoutModel::class);

        $this->assertEquals('foo', (new Renderer)->__invoke($layout, 'foo'));
    }

    /**
     *
     */
    public function test_invoke_with_layout_model()
    {
        $layout = $this->getCleanMock(LayoutModel::class);
        $model  = $this->getCleanMock(LayoutModel::class);

        $this->assertEquals($model, (new Renderer)->__invoke($layout, $model));
    }

    /**
     *
     */
    public function test_invoke_with_view_model()
    {
        $layout = $this->getCleanMock(LayoutModel::class);

        $layout->expects($this->once())
               ->method('child');

        $model = $this->getCleanMock(Model::class);

        $this->assertEquals($layout, (new Renderer)->__invoke($layout, $model));
    }
}
