<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Route\Match\Path;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Route;

class RouteTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $config = [
        'events' => [
            'route\match' => [
                Path::class
            ]
        ],
        'services' => [
            'route\generator' => Generator::class,
            'route\match'     => Match::class
        ]
    ];

    /**
     *
     */
    function test_mixed_response()
    {
        $route = new Route([Arg::ROUTE => '/']);

        $config = $this->config;

        $config['events']['route\match'] = [function() {
            return 'foo';
        }];

        $route->service(new App($config));

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        /** @var Response $result */
        $result = $route($request, $response, $next);

        $this->assertInstanceOf(Response::class, $result);
        $this->assertEquals('foo', $result->body());
    }

    /**
     *
     */
    function test_request()
    {
        $route = new Route([Arg::NAME => 'home', Arg::ROUTE => '/']);

        $route->service(new App($this->config));

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $request;
        };

        $result = $route($request, $response, $next);

        $this->assertInstanceOf(Request::class, $result);
        $this->assertEquals('home', $result[Arg::NAME]);
    }

    /**
     *
     */
    function test_response()
    {
        $route = new Route([Arg::ROUTE => '/']);

        $config = $this->config;

        $config['events']['route\match'] = [function() {
            return new Response(['body' => 'foo']);
        }];

        $route->service(new App($config));

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        /** @var Response $result */
        $result = $route($request, $response, $next);

        $this->assertInstanceOf(Response::class, $result);
        $this->assertEquals('foo', $result->body());
    }
}
