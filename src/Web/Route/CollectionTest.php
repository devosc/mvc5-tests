<?php
/**
 *
 */

namespace Mvc5\Test\Web\Route;

use Mvc5\App;
use Mvc5\Arg;
use Mvc5\Http\Request\Config as Request;
use Mvc5\Http\Response\Config as Response;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Service;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Route\Match\Path;
use Mvc5\Test\Test\TestCase;
use Mvc5\Web\Route\Collection;

class CollectionTest
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
                'route\match' => [Path::class]
            ],
            'routes' => [],
            'services' => [
                'route\generator' => Generator::class,
                'route\match' => new Service(Match::class, [new Param('middleware.route\match')]),
                'web\route' => [
                    Collection::class, new Plugin('route\match'), new Plugin('route\generator'), new Param('routes')
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
     * @return mixed|Request|Response
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
            'routes' => [['route' => '/']],
        ];

        $request  = new Request([Arg::URI => [Arg::PATH => '/']]);
        $response = new Response;

        $response = $this->route($config, $request, $response);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('foo', $response->body());
    }

    /**
     *
     */
    function test_request()
    {
        $config = [
            'routes' => [
                [
                    'name' => 'baz',
                    'route' => '/foo',
                    'children' => [
                        'bat' => ['route' => '/bar']
                    ]
                ]
            ],
        ];

        $request  = new Mvc5Request(['uri' => ['path' => '/foo/bar']]);
        $response = new Response;

        $request = $this->route($config, $request, $response, 'request');

        $this->assertInstanceOf(Mvc5Request::class, $request);
        $this->assertEquals('baz/bat', $request[Arg::NAME]);
    }

    /**
     *
     */
    function test_response()
    {
        $config = [
            'middleware' => [
                'route\match' => [function(/*$route, $request, $next*/) {
                    return new Response(['body' => 'foo']);
                }]
            ],
            'routes' => [['route' => '/']],
        ];

        $request  = new Request;
        $response = new Response;

        $response = $this->route($config, $request, $response);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals('foo', $response->body());
    }
}
