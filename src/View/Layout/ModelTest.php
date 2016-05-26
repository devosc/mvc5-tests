<?php
/**
 *
 */

namespace Mvc5\Test\View\Layout;

use Mvc5\Model as ViewModel;
use Mvc5\Layout as LayoutModel;
use Mvc5\View\Layout;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_model_not_view_model()
    {
        $layout = new Layout;

        $this->assertEquals('foo', $layout(new LayoutModel, 'foo'));
    }

    /**
     *
     */
    function test_model_already_a_layout_model()
    {
        $layout = new Layout;

        $model1 = new LayoutModel;
        $model2 = new LayoutModel;

        $this->assertTrue($model2 === $layout($model1, $model2));
    }

    /**
     *
     */
    function test_model_layout_assign_view_model()
    {
        $layout = new Layout;

        $layoutModel = new LayoutModel;
        $viewModel   = new ViewModel;

        $this->assertTrue($layoutModel === $layout($layoutModel, $viewModel));
    }
}
