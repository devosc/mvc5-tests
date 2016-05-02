<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Arg;
use Mvc5\Model;
use Mvc5\Layout;
use Mvc5\View\Template\Renderer;
use Mvc5\Test\Test\TestCase;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Renderer::class, new Renderer);
    }

    /**
     *
     */
    function test_not_a_view_model()
    {
        $renderer = new Renderer;

        $this->assertEquals(null, $renderer('foo'));
    }

    /**
     *
     */
    function test_invoke()
    {
        $model  = new HomeModel('home', ['title' => 'foo']);
        $layout = new Layout('layout', [Arg::CHILD_MODEL => $model]);

        $renderer = new Renderer([
            'home'   => __DIR__ . '/index.phtml',
            'layout' => __DIR__ . '/layout.phtml'
        ]);

        $this->assertEquals('<h1>Home</h1>', trim($renderer($layout)));
    }

    /**
     *
     */
    function test_invoke_no_template_exception()
    {
        $renderer = new Renderer;

        $this->setExpectedException('RuntimeException');

        $renderer(new Model);
    }

    /**
     *
     */
    function test_invoke_exception()
    {
        $renderer = new Renderer;
        $template = __DIR__ . '/exception.phtml';

        $this->setExpectedException('Exception', 'Exception Test');

        $renderer(new Model($template));
    }
}
