<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Response;
use Mvc5\Response\Send;
use Mvc5\Test\Test\TestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

class SendTest
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
                 ->method('send')
                 ->willReturn('foo');

        (new Send)->__invoke($response);
    }
}
