<?php
/**
 *
 */

namespace Mvc5\Test\Web;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Http\HttpRequest;
use Mvc5\Http\HttpResponse;
use Mvc5\Middleware;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plugin;
use Mvc5\Route\Generator;
use Mvc5\Route\Match\Path;
use Mvc5\Route\Route;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Route as WebRoute;

class RouteTest
    extends TestCase
{
    /**
     * @param array $config
     * @return App
     */
    protected function app(array $config = [])
    {
        return new App($this->config($config));
    }

    /**
     * @param array $config
     * @return array
     */
    protected function config(array $config = [])
    {
        return $config + [
            'middleware' => [
                'route\match' => [
                    Path::class
                ]
            ],
            'routes' => [],
            'services' => [
                'route\generator' => Generator::class,
                'route\match' => [Middleware::class, new Link, new Param('middleware.route\match')],
                'web\route' => [
                    WebRoute::class, new Plugin('route\match'), new Plugin('route\generator'), new Param('routes')
                ]
            ]
        ];
    }

    /**
     * @param $return
     * @return \Closure
     */
    protected function next($return = null)
    {
        return function($request, $response) use($return) {
            return 'request' === $return ? $request : $response;
        };
    }

    /**
     * @param $config
     * @param $request
     * @param $response
     * @param string $return
     * @return mixed|HttpRequest|HttpResponse
     */
    protected function route($config, $request, $response, $return = 'response')
    {
        return $this->app($config)->call('web\route', [$request, $response, $this->next($return)]);
    }

    /**
     *
     */
    function test_mixed_response()
    {
        $config = [
            'middleware' => [
                'route\match' => [function(/*$route, $request, $next*/) {
                    return 'foo';
                }]
            ],
            'routes' => [[
                'path' => '/'
            ]]
        ];

        $request  = new HttpRequest;
        $response = new HttpResponse;

        $response = $this->route($config, $request, $response);

        $this->assertInstanceOf(HttpResponse::class, $response);
        $this->assertEquals('foo', $response->body());
    }

    /**
     *
     */
    function test_request()
    {
        $config = [
            'middleware' => [
                'route\match' => [function(Route $route, HttpRequest $request, $next) {
                    return $request->with(['matched' => true, 'name' => $route['name'], 'path' => $route]);
                }]
            ],
            'routes' => [['name' => 'home', 'path' => '/']],
        ];

        $request  = new HttpRequest;
        $response = new HttpResponse;

        $request = $this->route($config, $request, $response, 'request');

        $this->assertInstanceOf(HttpRequest::class, $request);
        $this->assertEquals('home', $request[Arg::NAME]);
    }

    /**
     *
     */
    function test_response()
    {
        $config = [
            'middleware' => [
                'route\match' => [function(/*$route, $request, $next*/) {
                    return new HttpResponse(['body' => 'foo']);
                }]
            ],
            'routes' => [['path' => '/']],
        ];

        $request  = new HttpRequest;
        $response = new HttpResponse;

        $response = $this->route($config, $request, $response);

        $this->assertInstanceOf(HttpResponse::class, $response);
        $this->assertEquals('foo', $response->body());
    }
}
