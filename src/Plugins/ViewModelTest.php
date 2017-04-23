<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Model as Mvc5Model;
use Mvc5\Layout;
use Mvc5\Test\Test\TestCase;

class ViewModelTest
    extends TestCase
{
    /**
     *
     */
    function test_layout()
    {
        $plugin = new ViewModelPlugin(new App(['services' => ['layout' => [Layout::class, 'template' => 'layout']]]));

        $layout = $plugin->layout();

        $this->assertInstanceOf(Layout::class, $layout);
        $this->assertEquals('layout', $layout->template());

        $test = $plugin->layout(['foo' => 'bar'], 'test');

        $this->assertInstanceOf(Layout::class, $test);
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
        $plugin = new ViewModelPlugin(new App(['services' => ['view\model' => Mvc5Model::class]]));

        $this->assertInstanceOf(Mvc5Model::class, $plugin->view());
    }
}
