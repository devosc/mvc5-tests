<?php
/**
 *
 */

namespace Mvc5\Test\Url;

use Mvc5\Http\HttpUri;
use Mvc5\Url\Assemble;
use Mvc5\Test\Test\TestCase;

final class AssembleTest
    extends TestCase
{
    /**
     *
     */
    function test_uri()
    {
        $this->assertEquals(
            'http://foo:bar@localhost/app?foo=bar#baz', (new Assemble)(new HttpUri([
                'scheme' => 'http', 'host' => 'localhost', 'port' => 80, 'user' => 'foo', 'pass' => 'bar',
                    'path' => '/app', 'query' => ['foo' => 'bar'], 'fragment' => 'baz'
            ]))
        );
    }

    /**
     *
     */
    function test_url()
    {
        $this->assertEquals(
            'http://foo:bar@localhost:8080/app?foo=bar#baz', (new Assemble)->url(
                '/app', ['foo' => 'bar'], 'baz',
                    ['scheme' => 'http', 'host' => 'localhost', 'port' => 8080, 'user' => 'foo', 'pass' => 'bar']
            )
        );
    }

    /**
     *
     */
    function test_target()
    {
        $this->assertEquals('/app?foo=bar', Assemble::target('/app', ['foo' => 'bar']));
        $this->assertEquals('/?foo=bar', Assemble::target('', ['foo' => 'bar']));
        $this->assertEquals('/app?foo=bar', Assemble::target(new HttpUri(['path' => '/app', 'query' => ['foo' => 'bar']])));
        $this->assertEquals('/?foo=bar', Assemble::target(new HttpUri(['query' => ['foo' => 'bar']])));
    }
}
