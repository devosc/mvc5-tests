<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Test\Test\TestCase;
use Mvc5\ViewModel;

final class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_constants()
    {
        $service = new Controller;

        $model = $service->model(['foo' => 'bar']);
        $view  = $service->view('bar', ['baz' => 'bat']);

        $this->assertInstanceOf(ViewModel::class, $model);
        $this->assertInstanceOf(ViewModel::class, $view);
        $this->assertTrue($model !== $view);
        $this->assertEquals('home', $model->template());
        $this->assertEquals(['foo' => 'bar', '__template' => 'home'], $model->vars());
        $this->assertEquals('bar', $view->template());
        $this->assertEquals(['baz' => 'bat', '__template' => 'bar'], $view->vars());
    }

    /**
     *
     */
    function test_default_model()
    {
        $service = new Controller;

        $this->assertInstanceOf(ViewModel::class, $service->model());
    }

    /**
     *
     */
    function test_set_model()
    {
        $model   = new ViewModel;
        $service = new Controller($model);

        $this->assertInstanceOf(ViewModel::class, $service->model());

        $foo = $service->model(['foo' => 'bar']);

        $this->assertInstanceOf(ViewModel::class, $foo);
        $this->assertNotSame($model, $foo);
        $this->assertEquals('bar', $foo->get('foo'));

        $baz = $service->view('baz');

        $this->assertInstanceOf(ViewModel::class, $baz);
        $this->assertNotSame($model, $baz);
        $this->assertEquals('baz', $baz->template());
    }

    /**
     *
     */
    function test_view()
    {
        $service = new Controller;

        $this->assertInstanceOf(ViewModel::class, $service->view('foo', ['foo']));
    }
}
