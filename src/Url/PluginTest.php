<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Http\HttpUri;
use Mvc5\Request\HttpRequest;
use Mvc5\Test\Test\TestCase;
use Mvc5\Url\Generator;
use Mvc5\Url\Plugin;

class PluginTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $route = [
        'app' => [
            Arg::PATH => '/{controller}'
        ]
    ];

    /**
     *
     */
    function test_absolute_global()
    {
        $request = new HttpRequest([
            Arg::NAME => 'app',
            Arg::PARAMS => ['controller' => 'foo'],
            Arg::URI => [
                Arg::SCHEME => 'http',
                Arg::HOST => 'localhost',
                Arg::PORT => '8080'
            ]
        ]);

        $url = new Plugin($request, new Generator($this->route), null, true);

        $this->assertEquals('http://localhost:8080/foo', $url());
    }

    /**
     *
     */
    function test_absolute_local()
    {
        $request = new HttpRequest([
            Arg::NAME => 'app',
            Arg::PARAMS => ['controller' => 'foo'],
            Arg::URI => [
                Arg::SCHEME => 'http',
                Arg::HOST => 'localhost',
                Arg::PORT => '8080'
            ]
        ]);

        $url = new Plugin($request, new Generator($this->route));

        $this->assertEquals('http://localhost:8080/foo', $url('app', '', '', ['absolute' => true]));
    }

    /**
     *
     */
    function test_current()
    {
        $request = new HttpRequest([
            Arg::NAME => 'app',
            Arg::PARAMS => ['controller' => 'foo']
        ]);

        $url = new Plugin($request, new Generator($this->route));

        $this->assertEquals('/foo', $url(''));
        $this->assertEquals('/bar', $url([null, 'controller' => 'bar']));
    }

    /**
     *
     */
    function test_named()
    {
        $url = new Plugin(new HttpRequest, new Generator($this->route));

        $this->assertEquals('/foo', $url(['app', 'controller' => 'foo']));
    }

    /**
     *
     */
    function test_no_route_config()
    {
        $url = new Plugin(new HttpRequest([Arg::NAME => 'app']), new Generator($this->route));

        $this->assertEquals('/app.html?foo=bar#top', $url('/app.html', ['foo' => 'bar'], 'top'));
    }

    /**
     *
     */
    function test_slash_prefix()
    {
        $url = new Plugin(new HttpRequest([Arg::NAME => 'app']), function() { return 'foobar'; });

        $this->assertEquals('/app.html?foo=bar#top', $url('/app.html', ['foo' => 'bar'], 'top'));
    }

    /**
     *
     */
    function test_uri()
    {
        $url = new Plugin(new HttpRequest, new Generator($this->route));

        $uri = new HttpUri(['path' => '/app.html', 'query' => ['foo' => 'bar'], 'fragment' => 'top']);

        $this->assertEquals('/app.html?foo=bar#top', $url($uri));
    }


    /**
     *
     */
    function test_parent()
    {
        $request = new HttpRequest([
            Arg::NAME => 'app/foo/bar',
            Arg::PARAMS => ['user' => 'phpdev', 'controller' => 'foo'],
            Arg::PARENT => new HttpRequest([
                Arg::NAME => 'app/foo',
                Arg::PARAMS => ['user' => 'phpdev', 'controller' => 'foo'],
                Arg::PARENT => new HttpRequest([
                    Arg::NAME => 'app',
                    Arg::PARAMS => ['user' => 'phpdev'],
                ])
            ])
        ]);

        $route = [
            'app' => [
                Arg::PATH => '/{user}',
                Arg::CHILDREN => [
                    'foo' => [
                        Arg::PATH => '/{controller}',
                        Arg::CHILDREN => [
                            'bar' => [
                                Arg::PATH => '/bar'
                            ]
                        ]
                    ],
                    'baz' => [
                        Arg::PATH => '/{id}'
                    ]
                ]
            ]
        ];

        $url = new Plugin($request, new Generator($route));

        $this->assertEquals('/phpdev/foo/bar', $url());
        $this->assertEquals('/phpdev/foo/bar', $url('app/foo/bar'));
        $this->assertEquals('/phpdev/foo', $url('app/foo'));
        $this->assertEquals('/phpdev/foobar/bar', $url(['app/foo/bar', 'controller' => 'foobar']));
        $this->assertEquals('/phpdev', $url('app'));
        $this->assertEquals('/phpdev/2', $url(['app/baz', 'id' => 2]));
    }
}
