<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Test\Test\TestCase;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    function test_exception()
    {
        $renderer = new Renderer;

        $this->assertEquals('foo', $renderer->exception(new \Exception, null));
    }

    /**
     *
     */
    function test_render()
    {
        $renderer = new Renderer;

        $this->assertEquals('foo', $renderer->render(null));
    }
}
