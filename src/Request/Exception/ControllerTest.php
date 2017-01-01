<?php
/**
 *
 */

namespace Mvc5\Test\Request\Exception;

use Mvc5\Request\Config as Request;
use Mvc5\Request\Exception\Controller;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $controller = new Controller([]);

        $this->assertEquals(['exception' => 'baz'], $controller(new Request(['exception' => 'baz'])));
    }
}
