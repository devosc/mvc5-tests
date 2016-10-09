<?php
/**
 *
 */

namespace Mvc5\Test\Route\Router;

use Mvc5\Arg;
use Mvc5\App;
use Mvc5\Http\Error\NotFound;
use Mvc5\Request\Config as Mvc5Request;
use Mvc5\Route\Dispatch\Collection;
use Mvc5\Route\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Generator;
use Mvc5\Route\Match;
use Mvc5\Route\Match\Path;
use Mvc5\Route\Match\Method;
use Mvc5\Test\Test\TestCase;

class CollectionTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $config = [
        'routes' => [
            [
                'name'  => 'home',
                'route' => '/',
                'controller' => 'Home\Controller'
            ],
            'baz' => [
                'route' => '/foo',
                'children' => [
                    [
                        'name'     => 'bat',
                        'route' => '/bar',
                        'controller' => 'foobar'
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
            'route\generator'      => Generator::class,
            'route\match'          => Match::class,
            'route\match\path'     => Path::class,
            'route\match\method'   => Method::class
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
    function test_match_top()
    {
        $request = new Mvc5Request([Arg::URI => [Arg::PATH => '/']]);

        $dispatch = new Collection($this->config['routes']);
        $dispatch->service($this->app());

        /**
         * @var Request $request
         */
        $request = $dispatch($request);

        $this->assertEquals('home', $request->name());
        $this->assertEquals('Home\Controller', $request->controller());
    }

    /**
     *
     */
    function test_match_child()
    {
        $request = new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bar']]);

        $dispatch = new Collection($this->config['routes']);
        $dispatch->service($this->app());

        /**
         * @var Request $request
         */
        $request = $dispatch($request);

        $this->assertEquals('baz/bat', $request->name());
        $this->assertEquals('foobar', $request->controller());
    }

    /**
     *
     */
    function test_child_not_matched()
    {
        $request = new Mvc5Request([Arg::URI => [Arg::PATH => '/foo/bar/bat']]);

        $dispatch = new Collection($this->config['routes']);
        $dispatch->service($this->app());

        $this->assertNull($request->error());

        /** @var Request $request */
        $request = $dispatch($request);

        $this->assertEquals(new NotFound, $request->error());
    }
}
