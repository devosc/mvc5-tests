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
     *
     */
    function test_route()
    {
        $route = [
            'app' => new Route([
                Arg::NAME   => 'app',
                Arg::PATH   => '/foo',
                Arg::SCHEME => 'http',
                Arg::HOST   => 'localhost',
                Arg::PORT   => '8000',
                Arg::WILDCARD => true,
                ARG::TOKENS   => [['literal','/foo']]
            ])
        ];

        $generator = new Generator($route);

        $this->assertEquals('http://localhost:8000/foo/bar/baz', (string) $generator('app', ['bar' => 'baz']));
    }

    /**
     *
     */
    function test_null()
    {
        $generator = new Generator([]);
        $this->assertNull($generator('/foo/bar'));
    }
}
