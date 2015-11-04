<?php

namespace Mvc5\Test\Response\Exception;

use Mvc5\Response\Exception\Renderer;
use Mvc5\Response\Response;
use Mvc5\Test\Test\TestCase;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    public function test__invoke()
    {
        $mock = $this->getCleanMock(Renderer::class, ['__invoke']);

        $exception = $this->getCleanMock(\Exception::class);
        $response  = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setContent');

        $mock->expects($this->once())
             ->method('exception')
             ->will($this->returnArgument(0));

        $this->assertInstanceOf(Response::class, $mock->__invoke($exception, $response));
    }
}
