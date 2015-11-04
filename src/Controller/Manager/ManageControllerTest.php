<?php

namespace Mvc5\Test\Controller\Manager;

use Mvc5\Controller\Manager\ControllerManager;
use Mvc5\Controller\Manager\ManageController;
use Mvc5\Test\Test\TestCase;

class ManageControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test_action()
    {
        $mock = $this->getCleanMockForTrait(ManageController::class, ['action', 'setControllerManager']);

        $cm = $this->getCleanMock(ControllerManager::class);

        $cm->expects($this->once())
           ->method('action')
           ->willReturn('foo');

        $mock->setControllerManager($cm);

        $this->assertEquals('foo', $mock->action(function() {}));
    }

    /**
     *
     */
    public function test_controller()
    {
        $mock = $this->getCleanMockForTrait(ManageController::class, ['controller', 'setControllerManager']);

        $cm = $this->getCleanMock(ControllerManager::class);

        $cm->expects($this->once())
           ->method('controller')
           ->willReturn('foo');

        $mock->setControllerManager($cm);

        $this->assertEquals('foo', $mock->controller(null));
    }

    /**
     *
     */
    public function test_controllerManager()
    {
        $mock = $this->getCleanMockForTrait(ManageController::class, ['controllerManager', 'setControllerManager']);

        $this->assertEquals(null, $mock->controllerManager());
    }

    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMockForTrait(ManageController::class, ['exception', 'setControllerManager']);

        $cm = $this->getCleanMock(ControllerManager::class);

        $cm->expects($this->once())
           ->method('exception')
           ->willReturn('foo');

        $mock->setControllerManager($cm);

        $this->assertEquals('foo', $mock->exception(new \Exception));
    }

    /**
     *
     */
    public function test_dispatch()
    {
        $mock = $this->getCleanMockForTrait(ManageController::class, ['dispatch', 'setControllerManager']);

        $cm = $this->getCleanMock(ControllerManager::class);

        $cm->expects($this->once())
           ->method('dispatch')
           ->willReturn('foo');

        $mock->setControllerManager($cm);

        $this->assertEquals('foo', $mock->dispatch(function() {}));
    }

    /**
     *
     */
    public function test_setControllerManager()
    {
        $mock = $this->getCleanMockForTrait(ManageController::class, ['setControllerManager']);

        $cm = $this->getCleanMock(ControllerManager::class);

        $this->assertEquals(null, $mock->setControllerManager($cm));
    }
}
