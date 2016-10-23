<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    function test_no_controller()
    {
        $action = new Action;
        $this->assertNull($action());
    }

    /**
     *
     */
    function test_load_service_controller()
    {
        $action = new Action;
        $action->service(new App(['services' => ['web' => 'foo']]));

        $this->assertEquals('foo', $action(Controller::class));
    }

    /**
     *
     */
    function test_controller_with_existing_service()
    {
        $action = new Action;

        $controller = new Controller;
        $controller->service(new App(['services' => ['web' => 'foo']]));

        $this->assertEquals('foo', $action($controller));
    }

    /**
     *
     */
    function test_call_controller()
    {
        $action = new Action;

        $this->assertEquals('foo', $action(function() {}));
    }
}
