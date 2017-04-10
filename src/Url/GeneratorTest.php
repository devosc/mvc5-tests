<?php
/**
 *
 */

namespace Mvc5\Test\Url;

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
            'app' => [
                'scheme' => 'http',
                'host'   => 'localhost',
                'port'   => '8000',
                'path'   => '/foo',
                'children' => [
                    'bar' => [
                        'path' => '/bar'
                    ]
                ]
            ]
        ];

        $generator = new Generator($route);

        $this->assertEquals('http://localhost:8000/foo/bar', (string) $generator('app/bar'));
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
