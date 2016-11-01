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
    function test_set_model()
    {
        $model   = new Model;
        $service = new ModelService;

        $this->assertInstanceOf(Model::class, $service->setModel($model));
        $this->assertTrue($model === $service->model(['foo' => 'bar']));
        $this->assertTrue($model === $service->view('foobar'));
    }

    /**
     *
     */
    function test_model()
    {
        $service = new ModelService;

        $this->assertInstanceOf(Mvc5Model::class, $service->model());
    }

    /**
     *
     */
    function test_view()
    {
        $service = new ModelService;

        $this->assertInstanceOf(Mvc5Model::class, $service->view('foo', ['foo']));
    }

    /**
     *
     */
    function test_constants()
    {
        $service = new ViewService;

        $model = $service->model(['foo' => 'bar']);
        $view  = $service->view('bar', ['baz' => 'bat']);

        $this->assertInstanceOf(Model::class, $model);
        $this->assertInstanceOf(Model::class, $view);
        $this->assertTrue($model !== $view);
        $this->assertEquals('foobar', $model->template());
        $this->assertEquals(['foo' => 'bar', '__template' => 'foobar'], $model->vars());
        $this->assertEquals('bar', $view->template());
        $this->assertEquals(['baz' => 'bat', '__template' => 'bar'], $view->vars());
    }
}
