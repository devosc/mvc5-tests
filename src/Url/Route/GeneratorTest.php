<?php
/**
 *
 */

namespace Mvc5\Test\Url\Route;

use Mvc5\Arg;
use Mvc5\Route\Config as Route;
use Mvc5\Test\Test\TestCase;
use Mvc5\Url\Generator;

class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $route = [
            Arg::NAME     => 'home',
            Arg::ROUTE    => '/',
            Arg::CHILDREN => [
                'app' => new Route([
                    Arg::ROUTE    => 'foo',
                    Arg::WILDCARD => true,
                    ARG::TOKENS   => [['literal','foo']]
                ])
            ],
            Arg::SCHEME    => 'http',
            Arg::HOST      => 'localhost',
            Arg::PORT      => '8000'
        ];

        $options = [
            Arg::SCHEME    => 'http',
            Arg::HOST      => 'localhost',
            Arg::PORT      => '8000',
            Arg::CANONICAL => true
        ];

        $generator = new Generator($route, $options);

        $this->assertEquals('http://localhost:8000/foo/bar/baz', $generator('app', ['bar' => 'baz']));
    }
}
