<?php

namespace Mvc5\Test\View\Exception;

use Mvc5\View\Exception\ExceptionModel;
use Mvc5\View\Exception\Renderer;
use Mvc5\Test\Test\TestCase;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    public function test_renderer()
    {
        $mock = $this->getCleanMock(Renderer::class, ['__invoke']);

        $exception = $this->getCleanMock(\Exception::class);
        $model     = $this->getCleanMock(ExceptionModel::class);

        $model->expects($this->once())
              ->method('exception')
              ->will($this->returnArgument(0));

        $mock->expects($this->once())
             ->method('render')
             ->willReturn('foo');

        $this->assertEquals('foo', $mock->__invoke($exception, $model));
    }
}
