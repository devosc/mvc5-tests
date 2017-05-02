<?php
/**
 *
 */

namespace Mvc5\Test\Template;

use Mvc5\Arg;
use Mvc5\Template\Layout;
use Mvc5\Test\Test\TestCase;

class LayoutTest
    extends TestCase
{
    /**
     *
     */
    function test_model()
    {
        $layout = new Layout(null, [Arg::CHILD_MODEL => 'foo']);

        $this->assertEquals('foo', $layout->model());
    }

    /**
     *
     */
    function test_vars()
    {
        $vars = ['foo' => 'bar'];

        $layout = new Layout(null, $vars);

        $this->assertEquals($vars, $layout->vars());
    }
}
