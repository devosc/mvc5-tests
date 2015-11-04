<?php

namespace Mvc5\Test\Response\Dispatch;

use Mvc5\Response\Dispatch\Dispatch;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;

class DispatchTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $response = $this->getCleanMock(Response::class);

        $this->assertInstanceOf(Dispatch::class, new Dispatch($response));
    }

    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsDispatch::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }
}
