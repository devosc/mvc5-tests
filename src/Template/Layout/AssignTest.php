<?php
/**
 *
 */

namespace Mvc5\Test\Template\Layout;

use Mvc5\ViewLayout;
use Mvc5\ViewModel;
use Mvc5\Test\Test\TestCase;
use Mvc5\Template\Layout\Assign;

class AssignTest
    extends TestCase
{
    /**
     *
     */
    function test_view_model()
    {
        $layout = new ViewLayout;
        $model = new ViewModel;

        /** @var ViewLayout $result */
        $result = (new Assign($layout))($model);

        $this->assertInstanceOf(ViewLayout::class, $result);
        $this->assertNotSame($layout, $result);
        $this->assertInstanceOf(ViewModel::class, $result->model());
        $this->assertSame($model, $result->model());
    }

    /**
     *
     */
    function test_string_model()
    {
        $this->assertEquals('foo', (new Assign(new ViewLayout))('foo'));
    }
}
