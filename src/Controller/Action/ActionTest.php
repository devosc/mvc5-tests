<?php

namespace Mvc5\Test\Controller\Action;

use Mvc5\Controller\Action\Action;
use Mvc5\Response\Response;
use Mvc5\View\Model\Model;
use Mvc5\Test\Test\TestCase;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsAction::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }

    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Action::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn('foo');

        $this->assertTrue('foo' == $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_view_model_response()
    {
        $mock = $this->getCleanMock(Action::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $model = $this->getCleanMock(Model::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($model);

        $this->assertTrue($model === $mock->__invoke(function() {}));
    }

    /**
     *
     */
    public function test_invoke_http_response()
    {
        $mock = $this->getCleanMock(Action::class, ['__invoke']);

        $mock->expects($this->once())
             ->method('args')
             ->willReturn([]);

        $response = $this->getCleanMock(Response::class);

        $mock->expects($this->once())
             ->method('signal')
             ->willReturn($response);

        $this->assertTrue($response === $mock->__invoke(function() {}));
    }
}
