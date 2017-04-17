<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Http\Uri\Config as HttpUri;
use Mvc5\Request\Config as Request;
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
    function test_current()
    {
        $request = new Request([
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
        $url = new Plugin(new Request, new Generator($this->route));

        $this->assertEquals('/foo', $url(['app', 'controller' => 'foo']));
    }

    /**
     *
     */
    function test_no_route_config()
    {
        $url = new Plugin(new Request([Arg::NAME => 'app']), new Generator($this->route));

        $this->assertEquals('/app.html?foo=bar#top', $url('/app.html', ['foo' => 'bar'], 'top'));
    }

    /**
     *
     */
    function test_slash_prefix()
    {
        $url = new Plugin(new Request([Arg::NAME => 'app']), function() { return 'foobar'; });

        $this->assertEquals('/app.html?foo=bar#top', $url('/app.html', ['foo' => 'bar'], 'top'));
    }

    /**
     *
     */
    function test_uri()
    {
        $url = new Plugin(new Request, new Generator($this->route));

        $uri = new HttpUri(['path' => '/app.html', 'query' => ['foo' => 'bar'], 'fragment' => 'top']);

        $this->assertEquals('/app.html?foo=bar#top', $url($uri));
    }


    /**
     *
     */
    function test_parent()
    {
        $request = new Request([
            Arg::NAME => 'app/foo',
            Arg::PARAMS => ['user' => 'phpdev', 'controller' => 'foo'],
            Arg::PARENT => new Request([
                Arg::NAME => 'app',
                Arg::PARAMS => ['user' => 'phpdev'],
            ])
        ]);

        $route = [
            'app' => [
                Arg::PATH => '/{user}',
                Arg::CHILDREN => [
                    'foo' => [
                        Arg::PATH => '/{controller}'
                    ]
                ]
            ]
        ];

        $url = new Plugin($request, new Generator($route));

        $this->assertEquals('/phpdev/foo', $url());
        $this->assertEquals('/phpdev/foo', $url('app/foo'));
        $this->assertEquals('/phpdev/foobar', $url(['app/foo', 'controller' => 'foobar']));
        $this->assertEquals('/phpdev', $url('app'));
    }
}
