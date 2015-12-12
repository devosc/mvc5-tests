<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Layout;
use Mvc5\Model\Layout as LayoutModel;
use Mvc5\Model;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class LayoutTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke_with_no_model()
    {
        /** @var LayoutModel|Mock $layout */

        $layout = $this->getCleanMock(LayoutModel::class);

        $this->assertEquals(null, (new Layout)->__invoke($layout));
    }

    /**
     *
     */
    public function test_invoke_with_string_model()
    {
        /** @var LayoutModel|Mock $layout */

        $layout = $this->getCleanMock(LayoutModel::class);

        $this->assertEquals('foo', (new Layout)->__invoke($layout, 'foo'));
    }

    /**
     *
     */
    public function test_invoke_with_layout_model()
    {
        /** @var LayoutModel|Mock $layout */

        $layout = $this->getCleanMock(LayoutModel::class);

        $model = $this->getCleanMock(LayoutModel::class);

        $this->assertEquals($model, (new Layout)->__invoke($layout, $model));
    }

    /**
     *
     */
    public function test_invoke_child_model()
    {
        /** @var LayoutModel|Mock $layout */

        $layout = $this->getCleanMock(LayoutModel::class);

        $layout->expects($this->once())
               ->method('model');

        $model = $this->getCleanMock(Model::class);

        $this->assertEquals($layout, (new Layout)->__invoke($layout, $model));
    }
}
