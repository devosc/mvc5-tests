<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Response;
use Mvc5\Response\Status;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class StatusTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->getCleanMock(Status::class, [], [null]);
    }

    /**
     *
     */
    public function test_invoke()
    {
        $status = new Status('200');

        /** @var Response|Mock $response */

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setStatus')
                 ->willReturnSelf();

        $this->assertInstanceOf(Response::class, $status($response));
    }
}
