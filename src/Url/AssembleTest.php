<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Http\Uri\Config as Uri;
use Mvc5\Url\Assemble;
use Mvc5\Test\Test\TestCase;

class AssembleTest
    extends TestCase
{
    /**
     *
     */
    function test()
    {
        $this->assertEquals(
            'http://localhost/app?foo=bar#baz', (new Assemble)(new Uri([
                'scheme' => 'http', 'host' => 'localhost', 'port' => 80,
                    'path' => '/app', 'query' => ['foo' => 'bar'], 'fragment' => 'baz'
            ]))
        );
    }
}
