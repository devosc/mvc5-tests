<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Test\Test\TestCase;
use Mvc5\Url\Generator;

final class GeneratorTest
    extends TestCase
{
    /**
     *
     */
    function test_host()
    {
        $route = [
            'app' => [
                'scheme' => 'http',
                'host'   => [
                    'name' => '{subdomain}.app.dev'
                ],
                'port'   => 8000,
                'path'   => '/foo',
                'children' => [
                    'bar' => [
                        'path' => '/bar',
                        'wildcard' => true
                    ]
                ]
            ]
        ];

        $generator = new Generator($route);

        $this->assertEquals(
            'http://foobar.app.dev:8000/foo/bar/bat/baz',
                (string) $generator('app/bar', ['subdomain' => 'foobar', 'bat' => 'baz'])
        );
    }

    /**
     *
     */
    function test_route()
    {
        $route = [
            'app' => [
                'scheme' => 'http',
                'host'   => 'localhost',
                'port'   => 8000,
                'path'   => '/foo',
                'children' => [
                    'bar' => [
                        'path' => '/bar',
                        'wildcard' => true
                    ]
                ]
            ]
        ];

        $generator = new Generator($route);

        $this->assertEquals('http://localhost:8000/foo/bar/bat/baz', (string) $generator('app/bar', ['bat' => 'baz']));
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
