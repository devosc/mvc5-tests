<?php
/**
 *
 */

namespace Mvc5\Test\Route;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Filter;
use Mvc5\Test\Test\TestCase;

class FilterTest
    extends TestCase
{
    /**
     *
     */
    public function test_invoke()
    {
        $filter = new Filter;
        $route  = new Route([Arg::PATH => 'foo']);

        $filter($route);

        $this->assertEquals('foo', $route->path());
    }

    /**
     *
     */
    public function test_invoke_no_path()
    {
        $filter = new Filter;
        $route  = new Route;

        $filter($route);

        $this->assertEquals('/', $route->path());
    }
}
