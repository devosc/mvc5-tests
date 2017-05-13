<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Arg;
use Mvc5\Http\HttpUri;
use Mvc5\Test\Test\TestCase;

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
        $uri = new HttpUri([Arg::FRAGMENT => 'foo']);

        $this->assertEquals('foo', $uri->fragment());
    }

    /**
     *
     */
    function test_host()
    {
        $uri = new HttpUri([Arg::HOST => 'localhost']);

        $this->assertEquals('localhost', $uri->host());
    }

    /**
     *
     */
    function test_password()
    {
        $uri = new HttpUri([Arg::PASS => 'foo']);

        $this->assertEquals('foo', $uri->password());
    }

    /**
     *
     */
    function test_path()
    {
        $uri = new HttpUri([Arg::PATH => 'foo']);

        $this->assertEquals('foo', $uri->path());
    }

    /**
     *
     */
    function test_port()
    {
        $uri = new HttpUri([Arg::PORT => '80']);

        $this->assertEquals('80', $uri->port());
    }

    /**
     *
     */
    function test_query()
    {
        $uri = new HttpUri([Arg::QUERY => 'foo']);

        $this->assertEquals('foo', $uri->query());
    }

    /**
     *
     */
    function test_scheme()
    {
        $uri = new HttpUri([Arg::SCHEME => 'http']);

        $this->assertEquals('http', $uri->scheme());
    }

    /**
     *
     */
    function test_to_string()
    {
        $uri = new HttpUri([
            Arg::FRAGMENT => 'top',
            Arg::HOST     => 'localhost',
            Arg::PATH     => '/foobar',
            Arg::QUERY    => 'foo=bar',
            Arg::PORT     => '80',
            Arg::SCHEME   => 'http',
            Arg::USER     => 'user',
            Arg::PASS     => 'password'
        ]);

        $this->assertEquals('http://user:password@localhost/foobar?foo=bar#top', (string) $uri);
    }

    /**
     *
     */
    function test_user()
    {
        $uri = new HttpUri([Arg::USER => 'foo:bar']);

        $this->assertEquals('foo:bar', $uri->user());
    }
}
