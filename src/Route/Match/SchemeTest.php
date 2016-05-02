<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Response\Error\BadRequest;
use Mvc5\Route\Match\Scheme;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class SchemeTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $definition = new Definition;
        $route      = new Route;
        $scheme     = new Scheme;

        $this->assertEquals($route, $scheme($route, $definition));
    }

    /**
     *
     */
    function test_invoke_matched()
    {
        $definition = new Definition([Arg::SCHEME => 'http']);
        $route      = new Route([Arg::SCHEME => 'http']);
        $scheme     = new Scheme;

        $this->assertEquals($route, $scheme($route, $definition));
    }

    /**
     *
     */
    function test_invoke_not_matched()
    {
        $definition = new Definition([Arg::SCHEME => 'https']);
        $route      = new Route([Arg::SCHEME => 'http']);
        $scheme     = new Scheme;

        $this->assertInstanceOf(BadRequest::class, $scheme($route, $definition));
    }
}
