<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\App;
use Mvc5\Plugin\Link;
use Mvc5\Test\Test\TestCase;
use Mvc5\View\Engine\PhpEngine;
use Mvc5\View\Render;
use Mvc5\ViewLayout;
use Mvc5\ViewModel;

use const Mvc5\CHILD_MODEL;

final class RenderTest
    extends TestCase
{
    /**
     *
     */
    function test_default_view_directory()
    {
        $model  = new HomeModel('home', ['title' => 'foo']);

        $render = new Render(new App, new PhpEngine, ['directory' => __DIR__]);

        $this->assertEquals('<h1>foo</h1>', trim($render($model)));
    }

    /**
     *
     */
    function test_exception()
    {
        $render = new Render(new App, new PhpEngine);
        $template = __DIR__ . '/exception.phtml';

        $this->expectExceptionMessage('Exception Test');

        $render(new ViewModel($template));
    }

    /**
     *
     */
    function test_no_view_model_provider()
    {
        $render = new Render(new App, new PhpEngine, ['directory' => __DIR__]);

        $this->assertEquals('<h1>foo</h1>', trim($render->render(['__template' => 'home', 'title' => 'foo'])));
    }

    /**
     *
     */
    function test_not_a_view_model()
    {
        $render = new Render(new App, new PhpEngine);

        $this->assertEquals('foo', $render('foo'));
    }

    /**
     *
     */
    function test_render_child()
    {
        $app = new App([
            'services' => [
                'render' => [
                    Render::class, new Link, new PhpEngine, [
                        'paths' => [
                            'home'   => __DIR__ . '/index.phtml',
                            'layout' => __DIR__ . '/layout.phtml'
                        ]
                    ]
                ]
            ]
        ]);

        $model  = new HomeModel('home');
        $layout = new ViewLayout('layout', [CHILD_MODEL => $model]);

        $this->assertEquals('<h1>Home</h1>', trim($app->call('render', [$layout])));
    }

    /**
     *
     */
    function test_view_model_service_lookup()
    {
        $app = new App([
            'services' => [
                'baz' => new HomeModel('home', ['title' => 'foo'])
            ]
        ]);

        $render = new Render($app, new PhpEngine, ['directory' => __DIR__]);

        $this->assertEquals('<h1>foo</h1>', trim($render->render('baz')));
    }

    /**
     *
     */
    function test_render_without_view_model_service_lookup()
    {
        $app = new App();

        $render = new Render($app, new PhpEngine, ['directory' => __DIR__]);

        $this->assertEquals('<h1>foo</h1>', trim($render->render('/home', ['title' => 'foo'])));
    }
}
