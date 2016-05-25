<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\Test\Test\TestCase;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $action = new Action;

        $this->assertEquals('foo', $action(function() {}));
    }
}
