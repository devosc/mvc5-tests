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
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Route\Match\Controller;
use Mvc5\Route\Match\Path;
use Mvc5\Route\Match\Merge;
use Mvc5\Route\Match\Method;
use Mvc5\Response\Config as Response;
use Mvc5\Test\Route\Dispatch;
use Mvc5\Test\Test\TestCase;

class RouterTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $config = [
        'routes' => [
            'name'     => 'home',
            'route'    => '/',
            'options'  => ['prefix' => __NAMESPACE__ . '\\'],
            'children' => [
                [
                    'name'     => 'baz',
                    'route' => 'foo',
                    'children' => [
                        [
                            'name'  => 'bat',
                            'route' => '/bar',
                            'defaults' => [
                                'controller' => 'foo/bar'
                            ],
                        ]
                    ]
                ]
            ]
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

    /**
     * @return App
     */
    protected function app()
    {
        return new App($this->config);
    }

    /**
     *
     */
    function test_construct()
    {
        $route    = new Route;
        $dispatch = new Dispatch($route);

        $this->assertEquals(Request::class, $dispatch->requestClass());
        $this->assertTrue($route === $dispatch->configuredRoute());
    }

    /**
     *
     */
    function test_construct_with_route_request_class_name()
    {
        $route    = new Route;
        $dispatch = new Dispatch($route, 'foo');

        $this->assertEquals('foo', $dispatch->requestClass());
    }

    /**
     *
     */
    function test_definition()
    {
        $dispatch = new Dispatch(new Route);

        $dispatch->service($this->app());

        $this->assertInstanceOf(Route::class, $dispatch->definition([Arg::NAME => 'home', Arg::ROUTE => '/']));
    }

    /**
     *
     */
    function test_dispatch()
    {
        $route    = new Route([Arg::NAME => 'home', Arg::REGEX => '/']);
        $dispatch = new Dispatch($route);

        $dispatch->service($this->app());

        $this->assertInstanceOf(Mvc5Request::class, $dispatch->dispatch(new Mvc5Request([Arg::URI => [Arg::PATH => '/']]), $route));
    }

    /**
     *
     */
    function test_no_match()
    {
        $dispatch = new Dispatch(new Route);

        $dispatch->service($this->app());

        $this->assertNull($dispatch->match(new Request, new Route));
    }

    /**
     *
     */
    function test_name_parent_is_root()
    {
        $dispatch = new Dispatch(['name' => 'foo']);

        $this->assertEquals('bar', $dispatch->name('bar', 'foo'));
    }

    /**
     *
     */
    function test_name_parent_is_not_root()
    {
        $dispatch = new Dispatch(['name' => 'foo']);

        $this->assertEquals('bar/baz', $dispatch->name('baz', 'bar'));
    }

    /**
     *
     */
    function test_request_not_found()
    {
        $dispatch = new Dispatch(new Route([Arg::NAME => 'home', Arg::ROUTE => '/']));

        $dispatch->service($this->app());

        $request = $dispatch->request(new Request([Arg::URI => [Arg::PATH => '/foo']]));

        $this->assertInstanceOf(NotFound::class, $request[Arg::ERROR]);
    }

    /**
     *
     */
    function test_request_child_not_found()
    {
        $config = $this->config['routes'];
        $config['children'][] = [
            'name' => 'wildcard',
            'route' => ':wildcard',
            'constraints' => [
                'wildcard' => '.*'
            ]
        ];

        $dispatch = new Dispatch(new Route($config));

        $dispatch->service($this->app());

        $request = $dispatch->request(new Request([Arg::URI => [Arg::PATH => '/foo/baz']]));

        $this->assertNotEquals('wildcard', $request->name());
        $this->assertInstanceOf(NotFound::class, $request[Arg::ERROR]);
    }

    /**
     *
     */
    function test_request_error()
    {
        $request = new Request([Arg::METHOD => 'POST']);
        $route = new Route([Arg::ROUTE => '/', Arg::METHOD => 'GET']);

        $dispatch = new Dispatch($route);

        $dispatch->service($this->app());

        $request = $dispatch->request($request);

        $this->assertInstanceOf(MethodNotAllowed::class, $request[Arg::ERROR]);
    }

    /**
     *
     */
    function test_request_ok()
    {
        $request = new Request;
        $route = new Route([Arg::NAME => 'home', Arg::ROUTE => '/']);
        $dispatch = new Dispatch($route);

        $dispatch->service($this->app());

        $request = $dispatch->request($request);

        $this->assertEquals('home', $request->name());
    }

    /**
     *
     */
    function test_return_response()
    {
        $request = new Request;
        $route = new Route([Arg::NAME => 'home', Arg::ROUTE => '/']);
        $dispatch = new Dispatch($route);

        $config = $this->config;

        $config['events']['route\match'] = [function() {
            return new Response('foo');
        }];

        $dispatch->service(new App($config));

        $this->assertInstanceOf(Response::class, $dispatch->request($request));
    }

    /**
     *
     */
    function test_route_with_children()
    {
        $route = new Route($this->config['routes']);
        $dispatch = new Dispatch($route);
        $request  = new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bar']]);

        $dispatch->service($this->app());

        $request = $dispatch->request($request);

        $this->assertEquals('baz/bat', $request->name());
    }

    /**
     *
     */
    function test_route_with_children_as_iterator_object()
    {
        $config = $this->config['routes'];
        $config['children'] = new Config($config['children']);

        $dispatch = new Dispatch(new Route($config));
        $request  = new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bar']]);

        $dispatch->service($this->app());

        $request = $dispatch->request($request);

        $this->assertEquals('baz/bat', $request->name());
    }

    /**
     *
     */
    function test_child_controller_options()
    {
        $config = $this->config;

        $match = $config['events']['route\match'];

        array_unshift($match, 'route\match\merge') ;
        $match[] = 'route\match\controller';

        $config['events']['route\match'] = $match;

        $dispatch = new Dispatch(new Route($config['routes']));
        $request  = new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bar']]);

        $dispatch->service(new App($config));

        $request = $dispatch->request($request);

        $this->assertEquals('baz/bat', $request->name());
        $this->assertEquals(Foo\Bar\Controller::class, $request->controller());
    }

    /**
     *
     */
    function test_match_parent_named_params()
    {
        $config = [
            Arg::REGEX => '/(?P<controller>[a-zA-Z0-9]+)',
            Arg::DEFAULTS => ['limit' => '10'],
            Arg::CHILDREN => [
                [Arg::REGEX => '/(?P<foobar>bar)', Arg::DEFAULTS => ['limit' => '5']],
                [Arg::REGEX => '/(?P<action>bars)', Arg::DEFAULTS => ['limit' => '15']]
            ]
        ];

        $route = new Route($config);
        $dispatch = new Dispatch($route);
        $request  = new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bars']]);

        $dispatch->service($this->app());

        $request = $dispatch->request($request);

        $this->assertEquals(['controller' => 'foo', 'action' => 'bars', 'limit' => '15'], $request[Arg::PARAMS]);
    }

    /**
     *
     */
    function test_route_definition()
    {
        $route  = new Route(['regex' => 'foo']);
        $dispatch = new Dispatch(new Route);

        $this->assertEquals($route, $dispatch->routeDefinition($route));
    }

    /**
     *
     */
    function test_route_definition_without_regex()
    {
        $dispatch = new Dispatch(new Route);

        $dispatch->service($this->app());

        $this->assertInstanceOf(Route::class, $dispatch->routeDefinition([Arg::ROUTE => '/']));
    }

    /**
     *
     */
    function test_invoke()
    {
        $dispatch = new Dispatch(new Route([Arg::ROUTE => '/']));

        $dispatch->service($this->app());

        $this->assertInstanceOf(Mvc5Request::class, $dispatch(new Mvc5Request));
    }
}
