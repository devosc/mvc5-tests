<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Test\Test\TestCase;
use Mvc5\View\Render;

class RenderTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $render = new Render;

        $this->assertEquals('foo', $render('foo'));
    }
}
