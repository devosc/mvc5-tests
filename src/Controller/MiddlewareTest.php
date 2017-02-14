<?php
/**
 *
 */

namespace Mvc5\Test\Controller;

use Mvc5\App;
use Mvc5\Controller\Action;
use Mvc5\Controller\Middleware;
use Mvc5\Http\Request;
use Mvc5\Http\Request\Config as HttpRequest;
use Mvc5\Http\Response;
use Mvc5\Http\Response\Config as HttpResponse;
use Mvc5\Plugin\Link;
use Mvc5\Test\Test\TestCase;

class MiddlewareTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $config = [
            'services' => [
                'start' => function() {
                    return function(Request $request, Response $response, callable $next) {
                        return $next($request->with('version', '2.0'), $response);
                    };
                },
                'controller' => function() {
                    return function(Request $request, Response $response, callable $next) {
                        return $next($request, $response->with('body', 'foobar'));
                    };
                },
                'end' => function() {
                    return function(Request $request, Response $response, callable $next) {
                        return $next($request, $response->with('version', $request->version()));
                    };
                },
                'controller\action' => [Action::class, new Link],
            ]
        ];

        $app = new App($config);

        $middleware = new Middleware('controller', ['start', 'controller\action', 'end']);

        $middleware->service($app);

        /** @var Response $response */
        $response = $middleware(new HttpRequest, new HttpResponse);

        $this->assertEquals('foobar', $response->body());
        $this->assertEquals('2.0', $response->version());
    }
}
