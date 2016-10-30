<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\App;
use Mvc5\Model as Mvc5Model;
use Mvc5\Test\Test\TestCase;

class ViewModelTest
    extends TestCase
{
    /**
     *
     */
    function test_model()
    {
        $plugin = new ViewModelPlugin(new App);

        $this->assertInstanceOf(Mvc5Model::class, $plugin->model());
    }

    /**
     *
     */
    function test_custom_model()
    {
        $app = new App(['services' => ['Mvc5\Model' => ViewModel::class]]);

        $plugin = new ViewModelPlugin($app);

        $this->assertInstanceOf(ViewModel::class, $plugin->model());
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
    function test_view()
    {
        $plugin = new ViewModelPlugin(new App);

        $this->assertInstanceOf(Mvc5Model::class, $plugin->view());
    }


    /**
     *
     */
    function test_custom_view()
    {
        $app = new App(['services' => ['Mvc5\Model' => ViewModel::class]]);

        $plugin = new ViewModelPlugin($app);

        $this->assertInstanceOf(ViewModel::class, $plugin->view());
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
}
