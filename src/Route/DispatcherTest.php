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
    function test_definition()
    {
        $dispatcher = new Dispatcher;

        $this->assertEquals('foo', $dispatcher->definition([]));
    }

    /**
     *
     */
    function test_match()
    {
        $dispatcher = new Dispatcher;

        $this->assertEquals('foo', $dispatcher->match(null, null));
    }

    /**
     *
     */
    function test_exception()
    {
        $dispatcher = new Dispatcher;

        $this->assertEquals('foo', $dispatcher->exception(new Exception, null));
    }

    /**
     *
     */
    function test_route()
    {
        $dispatcher = new Dispatcher;

        $this->assertEquals('foo', $dispatcher->route(null));
    }
}
