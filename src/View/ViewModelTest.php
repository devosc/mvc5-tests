<?php

namespace Mvc5\Test\View;

use Mvc5\View\Model\Model;
use Mvc5\View\ViewModel;
use Mvc5\Test\Test\TestCase;

class ViewModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_setViewModel()
    {
        $mock = $this->getCleanMockForTrait(ViewModel::class, ['setModel']);

        $model = $this->getCleanMock(Model::class);

        $this->assertEquals(null, $mock->setModel($model));
    }

    /**
     *
     */
    public function test_model()
    {
        $mock = $this->getCleanMockForTrait(ViewModel::class, ['model']);

        $this->assertInstanceOf(Model::class, $mock->model(['bar' => 'baz']));
    }

    /**
     *
     */
    public function test_view()
    {
        $mock = $this->getCleanMockForTrait(ViewModel::class, ['view', 'setModel']);

        $model = $this->getCleanMock(Model::class);

        $model->expects($this->once())
              ->method('template')
              ->will($this->returnArgument(0));

        $mock->setModel($model);

        $mock->expects($this->once())
             ->method('model');

        $this->assertInstanceOf(Model::class, $mock->view('foo'));
    }
}
