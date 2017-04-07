<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Url\Collection;
use Mvc5\Test\Test\TestCase;

class CollectionTest
    extends TestCase
{
    /**
     * @var array
     */
    protected $routes = [
        'home' => [
            'path' => '/',
        ],
        'baz' => [
            'path' => '/foo',
            'children' => [
                'bat' => [
                    'path' => '/bar'
                ]
            ]
        ]
    ];

    /**
     *
     */
    function test()
    {
        $url = new Collection($this->routes);

        $this->assertEquals('/foo/bar', (string) $url('baz/bat'));
    }
}
