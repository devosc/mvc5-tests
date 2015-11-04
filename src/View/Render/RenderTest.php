<?php

namespace Mvc5\Test\View\Render;

use Mvc5\View\Render\Render;
use Mvc5\Test\Test\TestCase;

class RenderTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $this->assertInstanceOf(Render::class, new Render());
    }

    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsRender::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }
}
