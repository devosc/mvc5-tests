<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Response\Error\BadRequest;
use Mvc5\Route\Match\Hostname;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Definition\Config as Definition;
use Mvc5\Test\Test\TestCase;

class HostnameTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $definition = new Definition([Arg::HOSTNAME => 'foo']);
        $hostname   = new Hostname;
        $route      = new Route([Arg::HOSTNAME => 'foo']);

        $this->assertEquals($route, $hostname($route, $definition));
    }

    /**
     *
     */
    function test_invoke_not_matched()
    {
        $definition = new Definition([Arg::HOSTNAME => 'foo']);
        $hostname   = new Hostname;
        $route      = new Route([Arg::HOSTNAME => 'bar']);

        $this->assertInstanceOf(BadRequest::class, $hostname($route, $definition));
    }
}
