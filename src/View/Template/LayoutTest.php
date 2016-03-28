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
    public function test_invoke()
    {
        $layout = new Layout;

        $layout(new ViewLayout, new Model);

        $this->assertInstanceOf(ViewLayout::class, $layout(new ViewLayout, new Model));
    }
}
