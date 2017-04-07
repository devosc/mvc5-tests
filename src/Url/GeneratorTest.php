<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;
use Mvc5\Url\Generator;

class GeneratorTest
    extends TestCase
{
    /**
     * @param null $route
     * @param array $options
     * @return Generator
     */
    protected function generator($route = null, $options = [])
    {
        return new Generator($route ?: $this->route(), $options);
    }

    /**
     * @return array
     */
    protected function route()
    {
        return [
            Arg::NAME     => 'app',
            Arg::PATH    => '/{controller}',
        ];
    }

    /**
     *
     */
    function test_route()
    {
        $route = [
            Arg::NAME     => 'home',
            Arg::PATH    => '/',
            Arg::CHILDREN => [
                'app' => new Route([
                    Arg::PATH    => 'foo',
                    Arg::WILDCARD => true,
                    ARG::TOKENS   => [['literal','foo']]
                ])
            ],
            Arg::SCHEME => 'http',
            Arg::HOST   => 'localhost',
            Arg::PORT   => '8000',
        ];

        $generator = new Generator($route);

        $this->assertEquals('http://localhost:8000/foo/bar/baz', $generator('app', ['bar' => 'baz']));
    }
}
