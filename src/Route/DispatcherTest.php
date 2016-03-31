<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Exception;
use Mvc5\Test\Test\TestCase;

class DispatcherTest
    extends TestCase
{
    /**
     *
     */
    public function test_definition()
    {
        $dispatcher = new Dispatcher;

        $this->assertEquals('foo', $dispatcher->definition([]));
    }

    /**
     *
     */
    public function test_match()
    {
        $dispatcher = new Dispatcher;

        $this->assertEquals('foo', $dispatcher->match(null, null));
    }

    /**
     *
     */
    public function test_exception()
    {
        $dispatcher = new Dispatcher;

        $this->assertEquals('foo', $dispatcher->exception(new Exception, null));
    }

    /**
     *
     */
    public function test_route()
    {
        $dispatcher = new Dispatcher;

        $this->assertEquals('foo', $dispatcher->route(null));
    }
}
