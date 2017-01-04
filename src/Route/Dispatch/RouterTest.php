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
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Dispatch;
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Route\Match\Controller;
use Mvc5\Route\Match\Path;
use Mvc5\Route\Match\Merge;
use Mvc5\Route\Match\Method;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Test\TestCase;

class RouterTest
    extends TestCase
{
    /**
     * @return App
     */
    protected function app()
    {
        return new App($this->config());
    }

    /**
     * @param array $config
     * @return array
     */
    protected function config(array $config = [])
    {
        return $config + [
                'routes' => [
                    'name'     => 'home',
                    'route'    => '/',
                    'options'  => ['prefix' => __NAMESPACE__ . '\\'],
                    'children' => new Config([
                        'foo' => [
                            'route' => 'foo',
                            'children' => [
                                'bar' => new Route([
                                    'defaults' => ['controller' => 'foo/bar'],
                                    'route'    => '/bar',
                                    'regex'    => '/bar'
                                ]),
                                'bat' => [
                                    'defaults' => ['controller' => 'foo/bat'],
                                    'regex' => '/bat'
                                ]
                            ]
                        ]
                    ])
                ],
                'events' => [
                    'route\match' => [
                        'route\match\method',
                        'route\match\path',
                    ]
                ],
                'services' => [
                    'route\generator'        => Generator::class,
                    'route\match'            => Match::class,
                    'route\match\controller' => Controller::class,
                    'route\match\merge'      => Merge::class,
                    'route\match\method'     => Method::class,
                    'route\match\path'       => Path::class
                ]
            ];
    }

    /**
     * @return array
     */
    protected function routes()
    {
        return $this->config()['routes'];
    }

    /**
     *
     */
    function test_child_not_found()
    {
        $dispatch = new Dispatch(new Route($this->routes()));
        $dispatch->service($this->app());

        $request = $dispatch(new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/baz']]));

        $this->assertInstanceOf(NotFound::class, $request->error());
    }

    /**
     *
     */
    function test_child_route()
    {
        $dispatch = new Dispatch(new Route($this->routes()));
        $dispatch->service($this->app());

        $request = $dispatch(new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bat']]));

        $this->assertEquals('foo/bat', $request->name());
    }

    /**
     *
     */
    function test_error()
    {
        $dispatch = new Dispatch(new Route([Arg::ROUTE => '/', Arg::METHOD => 'GET']));
        $dispatch->service($this->app());

        $request = $dispatch(new Mvc5Request([Arg::METHOD => 'POST']));

        $this->assertInstanceOf(MethodNotAllowed::class, $request->error());
    }

    /**
     *
     */
    function test_not_found()
    {
        $dispatch = new Dispatch(new Route([Arg::ROUTE => '/']));
        $dispatch->service($this->app());

        $request = $dispatch(new Mvc5Request([Arg::URI => [Arg::PATH => '/foo']]));

        $this->assertInstanceOf(NotFound::class, $request->error());
    }

    /**
     *
     */
    function test_parent_controller_options()
    {
        $config = $this->config([
            'events' => [
                'route\match' => [
                    'route\match\merge',
                    'route\match\method',
                    'route\match\path',
                    'route\match\controller'
                ]
            ]
        ]);

        $dispatch = new Dispatch(new Route($config['routes']));
        $dispatch->service(new App($config));

        $request = $dispatch(new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bar']]));

        $this->assertEquals('foo/bar', $request->name());
        $this->assertEquals(Foo\Bar\Controller::class, $request->controller());
    }

    /**
     *
     */
    function test_parent_params()
    {
        $config = [
            Arg::REGEX => '/(?P<controller>[a-zA-Z0-9]+)',
            Arg::DEFAULTS => ['limit' => '10'],
            Arg::CHILDREN => [
                [Arg::REGEX => '/(?P<foobar>bar)', Arg::DEFAULTS => ['limit' => '5']],
                [Arg::REGEX => '/(?P<action>bars)', Arg::DEFAULTS => ['limit' => '15']]
            ]
        ];

        $dispatch = new Dispatch(new Route($config));
        $dispatch->service($this->app());

        $request = $dispatch(new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bars']]));

        $this->assertEquals(['controller' => 'foo', 'action' => 'bars', 'limit' => '15'], $request->params());
    }

    /**
     *
     */
    function test_request()
    {
        $dispatch = new Dispatch(new Route([Arg::NAME => 'app', Arg::ROUTE => '/']));
        $dispatch->service($this->app());

        $request = $dispatch(new Mvc5Request);

        $this->assertEquals('app', $request->name());
        $this->assertEquals('/', $request->path());
        $this->assertInstanceOf(Mvc5Request::class, $request);
    }

    /**
     *
     */
    function test_request_with_route_request_class()
    {
        $dispatch = new Dispatch(new Route([Arg::ROUTE => '/']), Request::class);
        $dispatch->service($this->app());

        $this->assertInstanceOf(Mvc5Request::class, $dispatch(new Mvc5Request));
    }

    /**
     *
     */
    function test_return_response()
    {
        $dispatch = new Dispatch(new Route([Arg::ROUTE => '/']));

        $config = $this->config([
            'events' => [
                'route\match' => [function() {
                    return new Response('foo');
                }]
            ]
        ]);

        $dispatch->service(new App($config));

        $this->assertInstanceOf(Response::class, $dispatch(new Mvc5Request));
    }
}
