<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Test\Test\TestCase;
use Mvc5\View\Render;
use Mvc5\View\Renderer;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Renderer::class, new Renderer(new Render));
    }
    /**
     *
     */
    function test_render_object()
    {
        $renderer = new Renderer(new Render);

        $model = new HomeModel(__DIR__ . '/home.phtml');

        $this->assertEquals('<h1>Home</h1>', trim($renderer->render($model, ['title' => 'Home'])));
    }

    /**
     *
     */
    function test_render_template_name()
    {
        $renderer = new Renderer(new Render);

        $template =__DIR__ . '/home.phtml';

        $this->assertEquals('<h1>Home</h1>', trim($renderer->render($template, ['title' => 'Home'])));
    }

    /**
     *
     */
    function test_invoke()
    {
        $renderer = new Renderer(new Render);

        $template =__DIR__ . '/home.phtml';

        $this->assertEquals('<h1>Home</h1>', trim($renderer($template, ['title' => 'Home'])));
    }
}
