<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Exception;
use Mvc5\Response\Error\BadRequest;
use Mvc5\Test\Response\Response;
use Mvc5\Test\Test\TestCase;

class ActionTest
    extends TestCase
{
    /**
     *
     */
    public function test_action()
    {
        $action = new Action;

        $this->assertEquals('foo', $action->action(function() {}));
    }

    /**
     *
     */
    public function test_error()
    {
        $action = new Action;

        $this->assertEquals('foo', $action->error(new BadRequest, new Response));
    }

    /**
     *
     */
    public function test_exception()
    {
        $action = new Action;

        $this->assertEquals('foo', $action->exception(new Exception, null));
    }
}
