<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Http\Error\BadRequest;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Scheme;
use Mvc5\Test\Test\TestCase;

class SchemeTest
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
        $route   = new Route([Arg::SCHEME => 'http']);
        $request = new HttpRequest([Arg::URI => [Arg::SCHEME => 'http']]);
        $scheme  = new Scheme;

        $this->assertEquals($request, $scheme($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_no_scheme()
    {
        $route   = new Route;
        $request = new HttpRequest;
        $scheme  = new Scheme;

        $this->assertEquals($request, $scheme($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_not_matched()
    {
        $route   = new Route([Arg::SCHEME => 'https']);
        $request = new HttpRequest([Arg::URI => [Arg::SCHEME => 'http']]);
        $scheme  = new Scheme;

        $this->assertInstanceOf(BadRequest::class, $scheme($route, $request, $this->next()));
    }
}
