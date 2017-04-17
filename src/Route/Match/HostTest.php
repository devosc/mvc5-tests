<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Http\Error\NotFound;
use Mvc5\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Host;
use Mvc5\Test\Test\TestCase;

class HostTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return function($route, $request) {
            return $request;
        };
    }

    /**
     *
     */
    function test_matched()
    {
        $route   = new Route([Arg::HOST => 'foo']);
        $host    = new Host;
        $request = new Request([Arg::URI => [Arg::HOST => 'foo']]);

        $this->assertEquals($request, $host($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_match_regex()
    {
        $route   = new Route([Arg::HOST => ['regex' => '(?P<domain>[^/]+)']]);
        $host    = new Host;
        $request = new Request([Arg::URI => [Arg::HOST => 'app.dev'], Arg::PARAMS => ['domain' => 'app.dev']]);

        $this->assertEquals($request, $host($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_regex_not_match()
    {
        $route   = new Route([Arg::HOST => ['regex' => '(?P<domain>[^/]+)']]);
        $host    = new Host;
        $request = new Request;

        $this->assertInstanceOf(NotFound::class, $host($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_not_matched()
    {
        $route   = new Route([Arg::HOST => 'foo']);
        $host    = new Host;
        $request = new Request([Arg::URI => [Arg::HOST => 'bar']]);

        $this->assertInstanceOf(NotFound::class, $host($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_optional()
    {
        $route   = new Route([Arg::HOST => 'foo', Arg::OPTIONAL => ['host']]);
        $host    = new Host;
        $request = new Request([Arg::URI => [Arg::HOST => 'bar']]);

        $this->assertNull($host($route, $request, $this->next()));
    }
}
