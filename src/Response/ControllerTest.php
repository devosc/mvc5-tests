<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Response;
use Mvc5\Response\Controller;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        /** @var Response|Mock $response */

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setContent')
                 ->willReturnSelf();

        $controller = new Controller;

        $this->assertInstanceOf(Response::class, $controller($response, null));
    }
}
