<?php
/**
 *
 */

namespace Mvc5\Test\View;

use Mvc5\Model as Mvc5Model;
use Mvc5\View\Model;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_setModel()
    {
        /** @var Model $mock */

        $mock = $this->getCleanMockForTrait(Model::class, ['setModel']);

        /** @var Mvc5Model $model */

        $model = $this->getCleanMock(Mvc5Model::class);

        $mock->setModel($model);
    }

    /**
     *
     */
    public function test_model()
    {
        /** @var Model $mock */

        $mock = $this->getCleanMockForTrait(Model::class, ['model']);

        $this->assertInstanceOf(Mvc5Model::class, $mock->model(['foo']));
    }

    /**
     *
     */
    public function test_view()
    {
        /** @var Model $mock */

        $mock = $this->getCleanMockForTrait(Model::class, ['view', 'setModel']);

        /** @var Mvc5Model|Mock $model */

        $model = $this->getCleanMock(Mvc5Model::class);

        $model->expects($this->once())
              ->method('template');

        $mock->setModel($model);

        $this->assertInstanceOf(Mvc5Model::class, $mock->view('foo', ['foo']));
    }
}
