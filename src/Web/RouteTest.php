<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Route\Config;
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Route\Match\Path;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Route;

class RouteTest
    extends TestCase
{
    /**
     *
     */
    function test_invoke()
    {
        $app = new App([
            'events' => [
                'route\match' => [
                    Path::class
                ]
            ],
            'services' => [
                'route\generator' => Generator::class,
                'route\match'     => Match::class
            ]
        ]);

        $route = new Route([Arg::ROUTE => '/']);

        $route->service($app);

        $request  = new Request;
        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $request;
        };

        $this->assertInstanceOf(Request::class, $route($request, $response, $next));
    }
}
