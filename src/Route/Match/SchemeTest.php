<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Http\Error\BadRequest;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Scheme;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ SCHEME, URI };

class SchemeTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return fn($route, $request) => $request;
    }

    /**
     *
     */
    function test_matched()
    {
        $route   = new Route([SCHEME => 'http']);
        $request = new HttpRequest([URI => [SCHEME => 'http']]);
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
        $route   = new Route([SCHEME => 'https']);
        $request = new HttpRequest([URI => [SCHEME => 'http']]);
        $scheme  = new Scheme;

        $this->assertInstanceOf(BadRequest::class, $scheme($route, $request, $this->next()));
    }
}
