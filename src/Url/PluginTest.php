<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Test\Test\TestCase;
use Mvc5\Url\Assemble;
use Mvc5\Url\Generator;
use Mvc5\Url\Plugin;

class PluginTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $route = [
        Arg::NAME => 'app',
        Arg::PATH => '/{controller}'
    ];

    /**
     *
     */
    function test_current()
    {
        $request = new Request([
            Arg::NAME => 'app',
            Arg::PARAMS => ['controller' => 'foo'],
            Arg::URI => [
                Arg::HOST => 'localhost',
                Arg::PORT => '8080',
                Arg::SCHEME => 'https'
            ]
        ]);

        $url = new Plugin($request, new Generator(new Assemble, $this->route));

        $this->assertEquals('https://localhost:8080/foo', $url());
    }

    /**
     *
     */
    function test_named()
    {
        $url = new Plugin(new Request, new Generator(new Assemble, $this->route));

        $this->assertEquals('/foo', $url('app', ['controller' => 'foo']));
    }
}
