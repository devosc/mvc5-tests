<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;
use Mvc5\View\Engine\PhpEngine;
use Mvc5\View\Render;
use Mvc5\View\Renderer;

final class RendererTest
    extends TestCase
{
    /**
     *
     */
    function test_render_object()
    {
        $renderer = new Renderer(new Render(new App, new PhpEngine));

        $model = new HomeModel(__DIR__ . '/home.phtml');

        $this->assertEquals('<h1>Home</h1>', trim($renderer($model, ['title' => 'Home'])));
    }

    /**
     *
     */
    function test_render_template_name()
    {
        $renderer = new Renderer(new Render(new App, new PhpEngine));

        $template =__DIR__ . '/home.phtml';

        $this->assertEquals('<h1>Home</h1>', trim($renderer($template, ['title' => 'Home'])));
    }
}
