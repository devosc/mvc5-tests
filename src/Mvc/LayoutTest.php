<?php
/**
 *
 */

namespace Mvc5\Test\Mvc;

use Mvc5\Mvc\Layout;
use Mvc5\Layout as LayoutModel;
use Mvc5\Model;
use Mvc5\Test\Test\TestCase;

class LayoutTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke_with_no_model()
    {
        $layout = new Layout;
        
        $this->assertEquals(null, $layout(new LayoutModel));
    }

    /**
     *
     */
    function test_invoke_with_string_model()
    {
        $layout = new Layout;

        $this->assertEquals('foo', $layout(new LayoutModel, 'foo'));
    }

    /**
     *
     */
    function test_invoke_with_layout_model()
    {
        $layout = new Layout;

        $this->assertEquals(new LayoutModel, $layout(new LayoutModel, new LayoutModel));
    }

    /**
     *
     */
    function test_invoke_child_model()
    {
        $layout = new Layout;

        $this->assertInstanceOf(LayoutModel::class, $layout(new LayoutModel, new Model));
    }
}
