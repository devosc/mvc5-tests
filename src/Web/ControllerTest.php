<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
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
                    return function(HttpRequest $request, HttpResponse $response, callable $next) {
                        return $next($request, $response);
                    };
                }
            ]
        ]);

        $controller = new Controller($app);

        $request = new HttpRequest([
            Arg::CONTROLLER => 'controller'
        ]);

        $response = new HttpResponse;

        $next = function(HttpRequest $request, HttpResponse $response) {
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
                    return function(HttpRequest $request, HttpResponse $response, callable $next) {
                        return 'foo';
                    };
                }
            ]
        ]);

        $controller = new Controller($app);

        $request  = new HttpRequest([
            Arg::CONTROLLER => 'controller'
        ]);

        $response = new HttpResponse;

        $next = function(HttpRequest $request, HttpResponse $response) {
            return $response;
        };

        $response = $controller($request, $response, $next);

        $this->assertEquals('foo', $response[Arg::BODY]);
    }

    /**
     *
     */
    function test_no_controller()
    {
        $controller = new Controller(new App);
        $request = new HttpRequest;
        $response = new HttpResponse;

        $next = function(HttpRequest $request, HttpResponse $response) {
            return $response;
        };

        $this->assertEquals($response, $controller($request, $response, $next));
    }
}
