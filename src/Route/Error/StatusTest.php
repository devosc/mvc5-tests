<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Response\Response;
use Mvc5\Response\Error;
use Mvc5\Route\Error\Status;
use Mvc5\Test\Test\TestCase;

class StatusTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setStatus')
                 ->willReturnSelf();

        $error = $this->getCleanMock(Error::class);

        $error->expects($this->once())
              ->method('status');

        $status = new Status;

        $this->assertInstanceOf(Response::class, $status($response, $error));
    }
}
