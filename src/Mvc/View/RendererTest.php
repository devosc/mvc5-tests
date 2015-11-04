<?php

namespace Mvc5\Test\Mvc\View;

use Mvc5\Mvc\View\Renderer;
use Mvc5\Response\Response;
use Mvc5\View\Model\ViewModel;
use Mvc5\Test\Test\TestCase;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke_response_string()
    {
        $mock = $this->getCleanMock(Renderer::class, ['__invoke']);

        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('content')
                 ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke($response));
    }

    /**
     *
     */
    public function test_invoke_with_not_model()
    {
        $mock     = $this->getCleanMock(Renderer::class, ['__invoke']);
        $model    = 'foo';
        $response = $this->getCleanMock(Response::class);

        $this->assertEquals('foo', $mock->__invoke($response, $model));
    }

    /**
     *
     */
    public function test_invoke_with_view_model()
    {
        $mock     = $this->getCleanMock(Renderer::class, ['__invoke']);
        $model    = $this->getCleanMock(ViewModel::class);
        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setContent');

        $mock->expects($this->once())
             ->method('render')
             ->willReturn('foo');

        $this->assertInstanceOf(Response::class, $mock->__invoke($response, $model));
    }

    /**
     *
     */
    public function test_invoke_exception()
    {
        $mock     = $this->getCleanMock(Renderer::class, ['__invoke']);
        $model    = $this->getCleanMock(ViewModel::class);
        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('setContent');

        $mock->expects($this->once())
             ->method('render')
             ->will($this->throwException(new \Exception));

        $mock->expects($this->once())
             ->method('exception');

        $this->assertInstanceOf(Response::class, $mock->__invoke($response, $model));
    }

    /**
     *
     */
    public function test_invoke_response_view_model()
    {
        $mock     = $this->getCleanMock(Renderer::class, ['__invoke']);
        $model    = $this->getCleanMock(ViewModel::class);
        $response = $this->getCleanMock(Response::class);

        $response->expects($this->once())
                 ->method('content')
                 ->willReturn($model);

        $response->expects($this->once())
                 ->method('setContent');

        $mock->expects($this->once())
             ->method('render')
             ->willReturn('foo');

        $this->assertInstanceOf(Response::class, $mock->__invoke($response));
    }
}
