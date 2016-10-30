<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Model as Mvc5Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_setModel()
    {
        $model = new Model;

        $model->setModel(new Mvc5Model);

        $this->assertInstanceOf(Mvc5Model::class, $model->model());
    }

    /**
     *
     */
    function test_model()
    {
        $model = new Model;

        $this->assertInstanceOf(Mvc5Model::class, $model->model(['foo']));
    }

    /**
     *
     */
    function test_view()
    {
        $model = new Model;

        $model->setModel(new Mvc5Model);

        $this->assertInstanceOf(Mvc5Model::class, $model->view('foo', ['foo']));
    }

    /**
     *
     */
    function test_view_template()
    {
        $model = new Model;

        $model->setModel(new Mvc5Model);

        $view = $model->view('foo', ['bar']);

        $this->assertEquals('foo', $view->template());
    }

    /**
     *
     */
    function test_view_constant()
    {
        $controller = new Controller;

        $view = $controller->model(['bar']);

        $this->assertInstanceOf(Mvc5Model::class, $view);
        $this->assertEquals('home', $view->template());
    }
}
