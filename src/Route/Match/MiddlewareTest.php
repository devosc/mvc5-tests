<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Middleware as HttpMiddleware;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Service;
use Mvc5\Request\Config as Mvc5Request;
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
use Mvc5\Route\Request\Config as Request;
use Mvc5\Test\Test\TestCase;

class MiddlewareTest
    extends TestCase
{
    /**
     *
     */
    function test_no_middleware()
    {
        $app     = new App;
        $method  = new Middleware($app);
        $route   = new Route;
        $request = new Request;

        $this->assertEquals(null, $request->controller());

        /** @var Request $result */
        $result = $method($request, $route);

        $this->assertEquals($result, $method($request, $route));
        $this->assertEquals(null, $result->controller());
    }

    /**
     *
     */
    function test_middleware()
    {
        $app     = new App(['services' => ['middleware' => HttpMiddleware::class]]);
        $method  = new Middleware($app);
        $route   = new Route(['middleware' => ['b']]);
        $request = new Request(['controller' => 'c']);

        $this->assertEquals('c', $request->controller());

        /** @var Request $result */
        $result = $method($request, $route);

        $this->assertEquals($request, $result);
        $this->assertInstanceOf(HttpMiddleware::class, $result->controller());
    }

    /**
     *
     */
    function test_middleware_path()
    {
        $config = [
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
                                'middleware' => [function($request, $response, $next) {
                                    $response['test'] = $response['test'] . ', c';
                                    return $next($request, $response);
                                }],
                                'controller' => function($request, $response, $next) {
                                    return $response['test'];
                                },
                            ]
                        ]
                    ]
                ]
            ],
            'events' => [
                'route\match' => [
                    'route\match\merge',
                    'route\match\method',
                    'route\match\path',
                    'route\match\middleware',
                ]
            ],
            'services' => [
                'middleware'             => new Service(HttpMiddleware::class),
                'route\generator'        => Generator::class,
                'route\match'            => Match::class,
                'route\match\controller' => Controller::class,
                'route\match\merge'      => Merge::class,
                'route\match\method'     => Method::class,
                'route\match\middleware' => [Middleware::class, new Link],
                'route\match\path'       => Path::class
            ]
        ];

        $dispatch = new Dispatch(new Route($config['routes']));
        $request  = new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bar']]);
        $response = new Response;

        $dispatch->service(new App($config));

        /** @var Request $request */
        $request = $dispatch($request);

        $this->assertEquals('a, b, c', call_user_func($request->controller(), $request, $response));
    }
}
