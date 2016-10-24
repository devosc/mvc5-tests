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
            'route' => '/',
        ],
        'baz' => [
            'route' => '/foo',
            'children' => [
                'bat' => [
                    'route' => '/bar'
                ]
            ]
        ]
    ];

    /**
     *
     */
    function test_url()
    {
        $url = new Collection($this->routes);

        $this->assertEquals('/foo/bar', $url('baz/bat'));
    }
}
