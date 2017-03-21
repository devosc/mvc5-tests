<?php
/**
 *
 */

namespace Mvc5\Test\Route\Dispatch;

use Mvc5\App;
use Mvc5\Http\Error\NotFound;
use Mvc5\Plugin\Param;
use Mvc5\Plugin\Plugin;
use Mvc5\Plugin\Service;
use Mvc5\Request\Config as Request;
use Mvc5\Route\Dispatch\Collection;
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
     * @return App
     */
    protected function app()
    {
        return new App($this->config());
    }

    /**
     * @return array
     */
    protected function config()
    {
        return [
            'middleware' => [
                'route\match' => [
                    'route\match\method',
                    'route\match\path',
                ]
            ],
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
            'services' => [
                'route\dispatch'  => [
                    Collection::class, new Plugin('route\match'), new Plugin('route\generator'), new Param('routes')
                ],
                'route\generator'    => Generator::class,
                'route\match'        => new Service(Match::class, [new Param('middleware.route\match')]),
                'route\match\path'   => Path::class,
                'route\match\method' => Method::class
            ]
        ];
    }

    /**
     * @param $request
     * @return Request
     */
    protected function dispatch(Request $request)
    {
        return $this->app()->call('route\dispatch', [$request]);
    }

    /**
     *
     */
    function test_child_not_matched()
    {
        $request = $this->dispatch(new Request(['uri' => ['path' => '/foo/bar/bat']]));

        $this->assertEquals(new NotFound, $request->error());
    }

    /**
     *
     */
    function test_match_child()
    {
        $request = $this->dispatch(new Request(['uri' => ['path' => '/foo/bar']]));

        $this->assertEquals('baz/bat', $request->name());
        $this->assertEquals('foobar', $request->controller());
    }

    /**
     *
     */
    function test_match_top()
    {
        $request = $this->dispatch(new Request(['uri' => ['path' => '/']]));

        $this->assertEquals('home', $request->name());
        $this->assertEquals('Home\Controller', $request->controller());
    }
}
