<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Closure;
use Mvc5\Http\Error\NotFound;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Host;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ HOST, PARAMS, OPTIONAL, URI };

final class HostTest
    extends TestCase
{
    /**
     * @return Closure
     */
    protected function next() : Closure
    {
        return fn($route, $request) => $request;
    }

    /**
     *
     */
    function test_matched()
    {
        $route   = new Route([HOST => 'foo']);
        $host    = new Host;
        $request = new HttpRequest([URI => [HOST => 'foo']]);

        $this->assertEquals($request, $host($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_match_regex()
    {
        $route   = new Route([HOST => ['regex' => '(?P<domain>[^/]+)']]);
        $host    = new Host;
        $request = new HttpRequest([URI => [HOST => 'app.dev'], PARAMS => ['domain' => 'app.dev']]);

        $this->assertEquals($request, $host($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_regex_not_match()
    {
        $route   = new Route([HOST => ['regex' => '(?P<domain>[^/]+)']]);
        $host    = new Host;
        $request = new HttpRequest;

        $this->assertInstanceOf(NotFound::class, $host($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_not_matched()
    {
        $route   = new Route([HOST => 'foo']);
        $host    = new Host;
        $request = new HttpRequest([URI => [HOST => 'bar']]);

        $this->assertInstanceOf(NotFound::class, $host($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_optional()
    {
        $route   = new Route([HOST => 'foo', OPTIONAL => ['host']]);
        $host    = new Host;
        $request = new HttpRequest([URI => [HOST => 'bar']]);

        $this->assertNull($host($route, $request, $this->next()));
    }
}
