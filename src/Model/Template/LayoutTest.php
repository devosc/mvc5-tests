<?php
/**
 *
 */

namespace Mvc5\Test\Model\Template;

use Mvc5\Arg;
use Mvc5\Layout;
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
    function test_model_set()
    {
        $vars = ['foo' => 'bar'];

        $layout = new Layout;

        $this->assertEquals($vars, $layout->model($vars));
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

    /**
     *
     */
    function test_vars_set()
    {
        $vars = ['foo' => 'bar'];

        $layout = new Layout;

        $this->assertEquals($vars, $layout->vars($vars));
    }
}
