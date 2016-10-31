<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Model as Mvc5Model;
use Mvc5\Model\ViewModel;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_model_injected()
    {
        $model = new Mvc5Model;

        $controller = new ModelController($model);

        /** @var ViewModel $vm */
        $vm = $controller(['foo' => 'bar']);

        $this->assertTrue($vm === $model);
        $this->assertEquals(['foo' => 'bar'], $vm->vars());

        $vm = $controller(['baz' => 'bat'], 'foobar');

        $this->assertTrue($vm === $model);
        $this->assertEquals(['foo' => 'bar', 'baz' => 'bat', '__template' => 'foobar'], $vm->vars());
    }

    /**
     *
     */
    function test_model_not_injected()
    {
        $controller = new ModelController;

        /** @var ViewModel $vm */
        $model = $controller(['foo' => 'bar']);
        $vm    = $controller(['baz' => 'bat'], 'foobar');

        $this->assertTrue($vm !== $model);
    }

    /**
     *
     */
    function test_model_constant()
    {
        $controller = new Controller;

        /** @var ViewModel $view */
        $view = $controller(['bar']);

        $this->assertInstanceOf(Model::class, $view);
        $this->assertEquals('home', $view->template());
    }
}
