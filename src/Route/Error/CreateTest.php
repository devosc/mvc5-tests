<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Response\Error\NotFound;
use Mvc5\Route\Error\Create;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;

class CreateTest
    extends TestCase
{
    /**
     *
     */
    function test_construct()
    {
        $this->assertInstanceOf(Create::class, new Create('foo', 'bar'));
    }

    /**
     *
     */
    function test_invoke()
    {
        $create = new Create('foo', 'bar');

        $this->assertInstanceOf(Route::class, $create(new Route, new NotFound));
    }
}
