<?php

namespace Mvc5\Test\Response\Send;

use Mvc5\Response\Send\Sender;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;

class SenderTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('send');

        $this->assertEquals(null, (new Sender)->__invoke($response));
    }
}
