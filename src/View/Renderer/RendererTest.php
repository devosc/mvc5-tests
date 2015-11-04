<?php

namespace Mvc5\Test\View\Renderer;

use Mvc5\View\Renderer\Renderer;
use Mvc5\Test\Test\TestCase;

class RendererTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $mock = $this->getCleanMock(Renderer::class);

        $this->assertInstanceOf(Renderer::class, $mock);
    }
}
