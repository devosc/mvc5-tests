<?php

namespace Mvc5\Test\View\Exception;

use Mvc5\View\Exception\View;
use Mvc5\Test\Test\TestCase;

class ViewTest
    extends TestCase
{
    /**
     *
     */
    public function test__construct()
    {
        $exception = $this->getCleanMock(\Exception::class);

        $view = new View($exception);

        $this->assertInstanceOf(View::class, $view);
    }

    /**
     *
     */
    public function test_args()
    {
        $mock = $this->getCleanMock(ArgsView::class, ['args']);

        $this->assertTrue(is_array($mock->args()));
    }
}
