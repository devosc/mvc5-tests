<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Http\HttpUri;
use Mvc5\Test\Test\TestCase;

use const Mvc5\{ FRAGMENT, HOST, PASS, PATH, PORT, QUERY, SCHEME, USER };

class UriTest
    extends TestCase
{
    /**
     *
     */
    function test_string()
    {
        $url = 'http://user:password@localhost:8080/foobar?foo=bar#top';
        $this->assertEquals($url, (string) new HttpUri($url));
    }

    /**
     *
     */
    function test_fragment()
    {
        $uri = new HttpUri([FRAGMENT => 'foo']);

        $this->assertEquals('foo', $uri->fragment());
    }

    /**
     *
     */
    function test_host()
    {
        $uri = new HttpUri([HOST => 'localhost']);

        $this->assertEquals('localhost', $uri->host());
    }

    /**
     *
     */
    function test_password()
    {
        $uri = new HttpUri([PASS => 'foo']);

        $this->assertEquals('foo', $uri->password());
    }

    /**
     *
     */
    function test_path()
    {
        $uri = new HttpUri([PATH => 'foo']);

        $this->assertEquals('foo', $uri->path());
    }

    /**
     *
     */
    function test_port()
    {
        $uri = new HttpUri([PORT => 80]);

        $this->assertEquals(80, $uri->port());
    }

    /**
     *
     */
    function test_query_array()
    {
        $args = ['foo' => 'bar', 'baz' => ['bat' => 'foobar']];

        $uri = new HttpUri([QUERY => $args]);

        $this->assertEquals($args, $uri->query());
    }

    /**
     *
     */
    function test_query_string()
    {
        $uri = new HttpUri([QUERY => 'foo']);

        $this->assertEquals('foo', $uri->query());
    }

    /**
     *
     */
    function test_scheme()
    {
        $uri = new HttpUri([SCHEME => 'http']);

        $this->assertEquals('http', $uri->scheme());
    }

    /**
     *
     */
    function test_to_string()
    {
        $uri = new HttpUri([
            FRAGMENT => 'top',
            HOST     => 'localhost',
            PATH     => '/foobar',
            QUERY    => 'foo=bar',
            PORT     => 80,
            SCHEME   => 'http',
            USER     => 'user',
            PASS     => 'password'
        ]);

        $this->assertEquals('http://user:password@localhost/foobar?foo=bar#top', (string) $uri);

        $uri = $uri->with(QUERY, ['foo' => 'bar', 'baz' => ['bat' => 'foobar']]);

        $this->assertEquals('http://user:password@localhost/foobar?foo=bar&baz[bat]=foobar#top', (string) $uri);
    }

    /**
     *
     */
    function test_user()
    {
        $uri = new HttpUri([USER => 'foo:bar']);

        $this->assertEquals('foo:bar', $uri->user());
    }
}
