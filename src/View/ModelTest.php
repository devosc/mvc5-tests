<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_constants()
    {
        $service = new ViewModel;

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

    /**
     *
     */
    function test_model()
    {
        $service = new ViewModel;

        $this->assertInstanceOf(Model::class, $service->model());
    }

    /**
     *
     */
    function test_set_model()
    {
        $model   = new Model;
        $service = new ViewModel;

        $this->assertInstanceOf(Model::class, $service->setModel($model));

        $foo = $service->model(['foo' => 'bar']);

        $this->assertInstanceOf(Model::class, $foo);
        $this->assertNotSame($model, $foo);
        $this->assertEquals('bar', $foo->get('foo'));

        $baz = $service->view('baz');

        $this->assertInstanceOf(Model::class, $baz);
        $this->assertNotSame($model, $baz);
        $this->assertEquals('baz', $baz->template());
    }

    /**
     *
     */
    function test_view()
    {
        $service = new ViewModel;

        $this->assertInstanceOf(Model::class, $service->view('foo', ['foo']));
    }
}
