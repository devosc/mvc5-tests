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
    public function test_setModel()
    {
        $model = new Model;

        $model->setModel(new Mvc5Model);

        $this->assertInstanceOf(Mvc5Model::class, $model->model());
    }

    /**
     *
     */
    public function test_model()
    {
        $model = new Model;

        $this->assertInstanceOf(Mvc5Model::class, $model->model(['foo']));
    }

    /**
     *
     */
    public function test_view()
    {
        $model = new Model;

        $model->setModel(new Mvc5Model);

        $this->assertInstanceOf(Mvc5Model::class, $model->view('foo', ['foo']));
    }
}
