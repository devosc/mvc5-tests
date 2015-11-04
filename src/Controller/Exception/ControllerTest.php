<?php

namespace Mvc5\Test\Controller\Exception;

use Mvc5\Controller\Exception\Controller;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Controller::class, ['__invoke']);

        $response = $this->getCleanMock(Response::class);

        $mock->expects($this->once())
             ->method('model')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke(new \Exception, $response));
    }
}
