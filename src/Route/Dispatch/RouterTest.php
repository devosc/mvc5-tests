<?php
/**
 *
 */

namespace Mvc5\Test\Route\Dispatch;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Config;
use Mvc5\Http\Error\NotFound;
use Mvc5\Http\Error\MethodNotAllowed;
use Mvc5\Middleware;
use Mvc5\Plugin\Link;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plugin;
use Mvc5\Request\HttpRequest;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Dispatch;
use Mvc5\Route\Generator;
use Mvc5\Route\Match\Controller;
use Mvc5\Route\Match\Path;
use Mvc5\Route\Match\Merge;
use Mvc5\Route\Match\Method;
use Mvc5\Response\HttpResponse;
use Mvc5\Test\Test\TestCase;

class RouterTest
    extends TestCase
{
    /**
     * @param array $config
     * @return App
     * @throws \Throwable
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
                        'route\match\method',
                        'route\match\path',
                    ]
                ],
                'routes' => [
                    [
                        'name'     => 'home',
                        'path'    => '/',
                        'controller' => 'Home\Controller',
                    ],
                    'app' => [
                        'path' => '/foo',
                        'options'  => ['prefix' => __NAMESPACE__ . '\\'],
                        'children' => new Config([
                            'bar' => [
                                'path' => '/bar',
                                'children' => [
                                    'baz' => new Route([
                                        'defaults' => ['controller' => 'bar/baz'],
                                        'path'    => '/baz',
                                        'regex'    => '/baz'
                                    ]),
                                    'bat' => [
                                        'defaults' => ['controller' => 'bar/bat'],
                                        'regex' => '/bat'
                                    ]
                                ]
                            ]
                        ])
                    ]
                ],
                'services' => [
                    'route\dispatch'  => [
                        Dispatch::class, new Plugin('route\match'), new Plugin('route\generator'), new Param('routes')
                    ],
                    'route\generator' => Generator::class,
                    'route\match' => [Middleware::class, new Link, new Param('middleware.route\match')],
                    'route\match\controller' => Controller::class,
                    'route\match\merge' => Merge::class,
                    'route\match\method' => Method::class,
                    'route\match\path' => Path::class
                ]
            ];
    }

    /**
     * @param HttpRequest $request
     * @param array $config
     * @return HttpRequest
     * @throws \Throwable
     */
    protected function dispatch($request, array $config = [])
    {
        return $this->app($config)->call('route\dispatch', [$request]);
    }

    /**
     *
     */
    function test_match_top()
    {
        $request = $this->dispatch(new HttpRequest(['uri' => ['path' => '/']]));

        $this->assertEquals('home', $request->name());
        $this->assertEquals('Home\Controller', $request->controller());
    }

    /**
     *
     */
    function test_child_not_found()
    {
        $request = $this->dispatch(new HttpRequest([Arg::URI => [Arg::PATH => '/foo/baz']]));

        $this->assertInstanceOf(NotFound::class, $request->error());
    }

    /**
     *
     */
    function test_child_route()
    {
        $request = $this->dispatch(new HttpRequest([Arg::URI => [Arg::PATH => '/foo/bar']]));

        $this->assertEquals('app/bar', $request->name());
    }

    /**
     *
     */
    function test_error()
    {
        $config = $this->config([
            'routes' => [['path' => '/', 'method' => 'GET']]]
        );

        $request = new HttpRequest([Arg::METHOD => 'POST']);

        $result = $this->dispatch($request, $config);

        $this->assertInstanceOf(HttpRequest::class, $result);
        $this->assertTrue($result !== $request);
        $this->assertInstanceOf(MethodNotAllowed::class, $result->error());
    }

    /**
     *
     */
    function test_not_found()
    {
        $config = $this->config([
            'routes' => [['path' => '/']]
        ]);

        $request = $this->dispatch(new HttpRequest([Arg::URI => [Arg::PATH => '/foo']]), $config);

        $this->assertInstanceOf(NotFound::class, $request->error());
    }

    /**
     *
     */
    function test_parent_controller_options()
    {
        $config = $this->config([
            'middleware' => [
                'route\match' => [
                    'route\match\merge',
                    'route\match\method',
                    'route\match\path',
                    'route\match\controller'
                ]
            ]
        ]);

        $request = $this->dispatch(new HttpRequest([Arg::URI => [Arg::PATH => '/foo/bar/baz']]), $config);

        $this->assertEquals('app/bar/baz', $request->name());
        $this->assertEquals(Bar\Baz\Controller::class, $request->controller());
    }

    /**
     *
     */
    function test_parent_params()
    {
        $config = $this->config([
            'routes' => new Route([[
                Arg::REGEX => '/(?P<controller>[a-zA-Z0-9]+)',
                Arg::DEFAULTS => ['limit' => '10'],
                Arg::CHILDREN => [
                    [Arg::REGEX => '/(?P<foobar>bar)', Arg::DEFAULTS => ['limit' => '5']],
                    [Arg::REGEX => '/(?P<action>bars)', Arg::DEFAULTS => ['limit' => '15']]
                ]
            ]])
        ]);

        $request = $this->dispatch(new HttpRequest([Arg::URI => [Arg::PATH => '/foo/bars']]), $config);

        $this->assertEquals(['controller' => 'foo', 'action' => 'bars', 'limit' => '15'], $request->params());
    }

    /**
     *
     */
    function test_request()
    {
        $config = $this->config(['routes' => [['name' => 'app', 'path' => '/']]]);

        $request = $this->dispatch(new HttpRequest(['uri' => ['path' => '/']]), $config);

        $this->assertEquals('app', $request->name());
        $this->assertEquals('/', $request->path());
        $this->assertInstanceOf(HttpRequest::class, $request);
    }

    /**
     *
     */
    function test_return_response()
    {
        $config = $this->config([
            'middleware' => [
                'route\match' => [function() {
                    return new HttpResponse('foo');
                }]
            ],
            'routes' => [
                [Arg::PATH => '/']
            ]
        ]);

        $response = $this->dispatch(new HttpRequest, $config);

        $this->assertInstanceOf(HttpResponse::class, $response);
    }
}
