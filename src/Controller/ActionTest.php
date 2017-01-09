<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\App;
use Mvc5\Controller\Action;
use Mvc5\Test\Test\TestCase;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    function test_call_controller()
    {
        $action = new Action(new App);

        $this->assertEquals('foo', $action(function() { return 'foo'; }));
    }

    /**
     *
     */
    function test_no_controller()
    {
        $action = new Action(new App);
        $this->assertNull($action());
    }
}
