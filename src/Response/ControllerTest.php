<?php
/**
 *
 */

namespace Mvc5\Test\Response;

use Mvc5\Response\Controller;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $controller = new Controller;

        $this->assertEquals(new Response('foo'), $controller(new Response, 'foo'));
    }
}
