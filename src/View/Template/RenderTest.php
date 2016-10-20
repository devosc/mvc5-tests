<?php
/**
 *
 */

namespace Mvc5\Test\View\Template;

use Mvc5\Arg;
use Mvc5\Layout;
use Mvc5\Model;
use Mvc5\Test\Test\TestCase;
use Mvc5\View\Render;

class RenderTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Render::class, new Render);
    }

    /**
     *
     */
    function test_not_a_view_model()
    {
        $render = new Render;

        $this->assertEquals('foo', $render('foo'));
    }

    /**
     *
     */
    function test_invoke()
    {
        $model  = new HomeModel('home');
        $layout = new Layout('layout', [Arg::CHILD_MODEL => $model]);

        $render = new Render([
            'home'   => __DIR__ . '/index.phtml',
            'layout' => __DIR__ . '/layout.phtml'
        ]);

        $this->assertEquals('<h1>Home</h1>', trim($render($layout)));
    }

    /**
     *
     */
    function test_default_view_directory()
    {
        $model  = new HomeModel('home', ['title' => 'foo']);

        $render = new Render([], __DIR__);

        $this->assertEquals('<h1>foo</h1>', trim($render($model)));
    }

    /**
     *
     */
    function test_invoke_no_template_exception()
    {
        $render = new Render;

        $this->setExpectedException('RuntimeException');

        $render(new Model);
    }

    /**
     *
     */
    function test_invoke_exception()
    {
        $render = new Render;
        $template = __DIR__ . '/exception.phtml';

        $this->setExpectedException('Exception', 'Exception Test');

        $render(new Model($template));
    }
}
