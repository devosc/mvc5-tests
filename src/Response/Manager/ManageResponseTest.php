<?php

namespace Mvc5\Test\Response\Manager;

use Mvc5\Response\Manager\ResponseManager;
use Mvc5\Response\Manager\ManageResponse;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;

class ManageResponseTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMockForTrait(ManageResponse::class, ['exception', 'setResponseManager']);

        $rm = $this->getCleanMock(ResponseManager::class);

        $rm->expects($this->once())
           ->method('exception')
           ->willReturn('foo');

        $mock->setResponseManager($rm);

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->exception($response, new \Exception));
    }

    /**
     *
     */
    public function test_send()
    {
        $mock = $this->getCleanMockForTrait(ManageResponse::class, ['send', 'setResponseManager']);

        $rm = $this->getCleanMock(ResponseManager::class);

        $rm->expects($this->once())
           ->method('send')
           ->willReturn('foo');

        $mock->setResponseManager($rm);

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->send($response));
    }

    /**
     *
     */
    public function test_setResponseManager()
    {
        $mock = $this->getCleanMockForTrait(ManageResponse::class, ['setResponseManager']);

        $rm = $this->getCleanMock(ResponseManager::class);

        $this->assertEquals(null, $mock->setResponseManager($rm));
    }

    /**
     *
     */
    public function test_responseManager()
    {
        $mock = $this->getCleanMockForTrait(ManageResponse::class, ['responseManager']);

        $this->assertEquals(null, $mock->responseManager());
    }
}
