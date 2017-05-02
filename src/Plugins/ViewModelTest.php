<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\ViewModel;
use Mvc5\ViewLayout;
use Mvc5\Test\Test\TestCase;

class ViewModelTest
    extends TestCase
{
    /**
     *
     */
    function test_layout()
    {
        $app = new App(['services' => ['layout' => [ViewLayout::class, 'template' => 'layout']]]);

        $plugin = new ViewModelPlugin($app);

        $layout = $plugin->layout();

        $this->assertInstanceOf(ViewLayout::class, $layout);
        $this->assertEquals('layout', $layout->template());

        $test = $plugin->layout(['foo' => 'bar'], 'test');

        $this->assertInstanceOf(ViewLayout::class, $test);
        $this->assertEquals('test', $test->template());
        $this->assertEquals('bar', $test->get('foo'));
    }

    /**
     *
     */
    function test_constant_model()
    {
        $controller = new ViewModelController(new App);

        $this->assertInstanceOf(ViewModel::class, $controller->model());
    }

    /**
     *
     */
    function test_constant_template()
    {
        $controller = new ViewModelController(new App);

        $view = $controller->view();

        $this->assertEquals('home', $view->template());
    }

    /**
     *
     */
    function test_custom_view()
    {
        $plugin = new ViewModelPlugin(new App(['services' => ['view\model' => ViewModel::class]]));

        $this->assertInstanceOf(ViewModel::class, $plugin->view());
    }

    /**
     *
     */
    function test_model()
    {
        $app = new App(['services' => ['view\model' => ViewModel::class]]);

        $plugin = new ViewModelPlugin($app);

        $this->assertInstanceOf(ViewModel::class, $plugin->model());
    }

    /**
     *
     */
    function test_view()
    {
        $plugin = new ViewModelPlugin(new App(['services' => ['view\model' => ViewModel::class]]));

        $this->assertInstanceOf(ViewModel::class, $plugin->view());
    }
}
