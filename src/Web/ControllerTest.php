<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Controller;

class ControllerTest
    extends TestCase
{
    /**
     *
     */
    function test_controller_returns_response()
    {
        $app = new App([
            'services' => [
                'controller' => function() {
                    return function(Request $request, Response $response, callable $next) {
                        return $next($request, $response);
                    };
                }
            ]
        ]);

        $controller = new Controller;
        $controller->service($app);

        $request = new Request([
            Arg::CONTROLLER => 'controller'
        ]);

        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $this->assertEquals($response, $controller($request, $response, $next));
    }

    /**
     *
     */
    function test_controller_returns_response_body()
    {
        $app = new App([
            'services' => [
                'controller' => function() {
                    return function(Request $request, Response $response, callable $next) {
                        return 'foo';
                    };
                }
            ]
        ]);

        $controller = new Controller;
        $controller->service($app);

        $request  = new Request([
            Arg::CONTROLLER => 'controller'
        ]);

        $response = new Response;

        $next = function(Request $request, Response $response) {
            return $response;
        };

        $response = $controller($request, $response, $next);

        $this->assertEquals('foo', $response[Arg::BODY]);
    }
}
