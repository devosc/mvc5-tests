<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Controller;

use const Mvc5\{ BODY, CONTROLLER };

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
                'controller' => fn() => fn(HttpRequest $request, HttpResponse $response) => $response
            ]
        ]);

        $controller = new Controller($app);

        $request = new HttpRequest([
            CONTROLLER => 'controller'
        ]);

        $response = new HttpResponse;

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $this->assertEquals($response, $controller($request, $response, $next));
    }

    /**
     *
     */
    function test_controller_returns_response_body()
    {
        $app = new App([
            'services' => [
                'controller' => fn() => fn() => 'foo'
            ]
        ]);

        $controller = new Controller($app);

        $request  = new HttpRequest([
            CONTROLLER => 'controller'
        ]);

        $response = new HttpResponse;

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $response = $controller($request, $response, $next);

        $this->assertEquals('foo', $response[BODY]);
    }

    /**
     *
     */
    function test_no_controller()
    {
        $controller = new Controller(new App);
        $request = new HttpRequest;
        $response = new HttpResponse;

        $next = fn(HttpRequest $request, HttpResponse $response) => $response;

        $this->assertEquals($response, $controller($request, $response, $next));
    }
}
