<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\App;
use Mvc5\Http\HttpMiddleware;
use Mvc5\Middleware;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plugin;
use Mvc5\Request\HttpRequest;
use Mvc5\Response\HttpResponse;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Dispatch;
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ METHOD, PATH, URI };

final class MiddlewareTest
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
     * @throws \Throwable
     */
    function test_middleware()
    {
        $app         = new App(['services' => ['http\middleware' => [HttpMiddleware::class, 'service' => new Link]]]);
        $middleware  = new Match\Middleware($app, 'controller');
        $route       = new Route(['middleware' => ['function1']]);
        $request     = new HttpRequest(['controller' => 'function2']);

        /** @var HttpRequest $result */
        $result = $middleware($route, $request, $this->next());

        $this->assertNotEquals($request, $result);
        $this->assertEquals('function2', $request->controller());
        $this->assertEquals(new HttpMiddleware($app, ['function1', 'function2']), $result->controller());
    }

    /**
     * @throws \Throwable
     */
    function test_middleware_path()
    {
        $config = [
            'middleware' => [
                'route\match' => [
                    'route\match\merge',
                    'route\match\method',
                    'route\match\path',
                    'route\match\controller',
                    'route\match\middleware',
                ]
            ],
            'routes' => [[
                'name'       => 'home',
                'path'      => '/',
                'middleware' => [fn(HttpRequest $request, HttpResponse $response, callable $next) =>
                    $next($request, $response->with('test', 'a'))],
                'children' => [
                    [
                        'name'     => 'baz',
                        'path' => 'foo',
                        'middleware' => [fn(HttpRequest $request, HttpResponse $response, callable $next) =>
                            $next($request, $response->with('test', $response['test'] . ', b'))],
                        'children' => [
                            [
                                'name'  => 'bat',
                                'path' => '/bar',
                                'middleware' => [
                                    fn(HttpRequest $request, HttpResponse $response, callable $next) =>
                                        $next($request, $response->with('test', $response['test'] . ', c')),
                                    fn(HttpRequest $request, HttpResponse $response, callable $next) => $response['test']
                                ],
                            ]
                        ]
                    ]
                ]
            ]],
            'services' => [
                'http\middleware' => [HttpMiddleware::class, 'service' => new Link],
                'route\dispatch' => [
                    Dispatch::class, new Plugin('route\match'), new Plugin('route\generator'), new Param('routes')
                ],
                'route\generator'        => Generator::class,
                'route\match'            => [Middleware::class, new Link, new Param('middleware.route\match')],
                'route\match\controller' => Match\Controller::class,
                'route\match\merge'      => Match\Merge::class,
                'route\match\method'     => Match\Method::class,
                'route\match\middleware' => [Match\Middleware::class, new Link],
                'route\match\path'       => Match\Path::class
            ]
        ];

        $app      = new App($config);
        $request  = new HttpRequest([METHOD => 'GET', URI => [PATH => '/foo/bar']]);
        $response = new HttpResponse;

        $request = $app->call('route\dispatch', [$request]);
        $middleware = $request->controller();

        $this->assertEquals('a, b, c', $middleware($request, $response));
    }

    /**
     * @throws \Throwable
     */
    function test_middleware_without_controller()
    {
        $app         = new App(['services' => ['http\middleware' => [HttpMiddleware::class, 'service' => new Link]]]);
        $middleware  = new Match\Middleware($app);
        $route       = new Route(['middleware' => ['b', 'c']]);
        $request     = new HttpRequest;

        /** @var HttpRequest $result */
        $result = $middleware($route, $request, $this->next());

        $this->assertNotEquals($request, $result);
        $this->assertNull($request->controller());
        $this->assertEquals(new HttpMiddleware($app, ['b', 'c']), $result->controller());
    }

    /**
     *
     */
    function test_no_middleware()
    {
        $app        = new App;
        $middleware = new Match\Middleware($app);
        $route      = new Route;
        $request    = new HttpRequest;

        $this->assertNull($request->controller());

        /** @var HttpRequest $result */
        $result = $middleware($route, $request, $this->next());

        $this->assertEquals($result, $middleware($route, $request, $this->next()));
        $this->assertNull($result->controller());
    }
}
