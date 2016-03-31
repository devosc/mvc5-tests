<?php
/**
 *
 */

namespace Mvc5\Test\Route\Exception;

use Mvc5\Route\Exception\Controller;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    public function test_construct()
    {
        $this->assertInstanceOf(Controller::class, new Controller([]));
    }

    /**
     *
     */
    public function test_invoke()
    {
        $controller = new Controller([]);

        $this->assertEquals(['exception' => 'baz'], $controller(['exception' => 'baz']));
    }
}
