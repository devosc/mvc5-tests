<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Middleware as HttpMiddleware;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Service;
use Mvc5\Request\Config as Request;
use Mvc5\Response\Config as Response;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Dispatch;
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Route\Match\Controller;
use Mvc5\Route\Match\Path;
use Mvc5\Route\Match\Merge;
use Mvc5\Route\Match\Method;
use Mvc5\Route\Match\Middleware;
use Mvc5\Test\Test\TestCase;

class MiddlewareTest
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
    function test_middleware()
    {
        $app         = new App(['services' => ['middleware' => HttpMiddleware::class]]);
        $middleware  = new Middleware($app, 'controller');
        $route       = new Route(['middleware' => ['b']]);
        $request     = new Request(['controller' => 'c']);

        $this->assertEquals('c', $request->controller());

        /** @var Request $result */
        $result = $middleware($route, $request, $this->next());

        $this->assertEquals($request, $result);
        $this->assertEquals(new HttpMiddleware(['b', 'c']), $result->controller());
    }

    /**
     *
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
            'routes' => [
                'name'       => 'home',
                'route'      => '/',
                'middleware' => [function($request, $response, $next) {
                    $response['test'] = 'a';
                    return $next($request, $response);
                }],
                'children' => [
                    [
                        'name'     => 'baz',
                        'route' => 'foo',
                        'middleware' => [function($request, $response, $next) {
                            $response['test'] = $response['test'] . ', b';
                            return $next($request, $response);
                        }],
                        'children' => [
                            [
                                'name'  => 'bat',
                                'route' => '/bar',
                                'middleware' => [
                                    function($request, $response, $next) {
                                        $response['test'] = $response['test'] . ', c';
                                        return $next($request, $response);
                                    },
                                    function($request, $response, $next) {
                                        return $response['test'];
                                    }
                                ],
                            ]
                        ]
                    ]
                ]
            ],
            'services' => [
                'middleware' => new Service(HttpMiddleware::class),
                'route\dispatch' => [
                    Dispatch::class, new Plugin('route\match'), new Plugin('route\generator'), new Param('routes')
                ],
                'route\generator'        => Generator::class,
                'route\match'            => new Service(Match::class, [new Param('middleware.route\match')]),
                'route\match\controller' => [Controller::class, null, ['middleware' => true]],
                'route\match\merge'      => Merge::class,
                'route\match\method'     => Method::class,
                'route\match\middleware' => [Middleware::class, new Link],
                'route\match\path'       => Path::class
            ]
        ];

        $app      = new App($config);
        $request  = new Request([Arg::URI => [Arg::PATH => '/foo/bar']]);
        $response = new Response;

        $request = $app->call('route\dispatch', [$request]);
        $middleware = $request->controller();

        $this->assertEquals('a, b, c', $middleware($request, $response));
    }

    /**
     *
     */
    function test_middleware_without_controller()
    {
        $app         = new App(['services' => ['middleware' => HttpMiddleware::class]]);
        $middleware  = new Middleware($app);
        $route       = new Route(['middleware' => ['b', 'c']]);
        $request     = new Request;

        $this->assertNull($request->controller());

        /** @var Request $result */
        $result = $middleware($route, $request, $this->next());

        $this->assertEquals($request, $result);
        $this->assertEquals(new HttpMiddleware(['b', 'c']), $result->controller());
    }

    /**
     *
     */
    function test_no_middleware()
    {
        $app        = new App;
        $middleware = new Middleware($app);
        $route      = new Route;
        $request    = new Request;

        $this->assertNull($request->controller());

        /** @var Request $result */
        $result = $middleware($route, $request, $this->next());

        $this->assertEquals($result, $middleware($route, $request, $this->next()));
        $this->assertNull($result->controller());
    }
}
