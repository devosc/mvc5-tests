<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Model;
use Mvc5\Layout as ViewLayout;
use Mvc5\View\Template\Layout;
use Mvc5\Test\Test\TestCase;

class LayoutTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke_model()
    {
        $layout = new Layout;

        $this->assertInstanceOf(ViewLayout::class, $layout(new ViewLayout, new Model));
    }

    /**
     *
     */
    function test_invoke_string_model()
    {
        $layout = new Layout;

        $this->assertInstanceOf(ViewLayout::class, $layout(new ViewLayout, 'foo'));
    }
}
