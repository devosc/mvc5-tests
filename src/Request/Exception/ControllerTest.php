<?php
/**
 *
 */

namespace Mvc5\Test\Request\Exception;

use Mvc5\Request\Exception\Controller;
use Mvc5\Request\HttpRequest;
use Mvc5\Template\Model;
use Mvc5\Test\Test\TestCase;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $controller = new Controller(new Model);

        $this->assertEquals(new Model(['exception' => 'baz']), $controller(new HttpRequest(['exception' => 'baz'])));
    }
}
