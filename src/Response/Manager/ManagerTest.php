<?php

namespace Mvc5\Test\Response\Manager;

use Mvc5\Response\Manager\Manager;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;

class ManagerTest
    extends TestCase
{
    /**
     *
     */
    public function test_exception()
    {
        $mock = $this->getCleanMock(Manager::class, ['exception']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->exception($response, new \Exception));
    }

    /**
     *
     */
    public function test_send()
    {
        $mock = $this->getCleanMock(Manager::class, ['send']);

        $mock->expects($this->once())
             ->method('trigger')
             ->willReturn('foo');

        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->send($response));
    }
}
