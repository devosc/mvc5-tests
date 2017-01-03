<?php
/**
 *
 */

namespace Mvc5\Test\Http;

use Mvc5\Arg;
use Mvc5\Http\Uri\Config as Uri;
use Mvc5\Test\Test\TestCase;

class UriTest
    extends TestCase
{
    /**
     *
     */
    function test_fragment()
    {
        $uri = new Uri([Arg::FRAGMENT => 'foo']);

        $this->assertEquals('foo', $uri->fragment());
    }

    /**
     *
     */
    function test_host()
    {
        $uri = new Uri([Arg::HOST => 'localhost']);

        $this->assertEquals('localhost', $uri->host());
    }

    /**
     *
     */
    function test_method()
    {
        $uri = new Uri([Arg::METHOD => 'GET']);

        $this->assertEquals('GET', $uri->method());
    }

    /**
     *
     */
    function test_password()
    {
        $uri = new Uri([Arg::PASS => 'foo']);

        $this->assertEquals('foo', $uri->password());
    }

    /**
     *
     */
    function test_path()
    {
        $uri = new Uri([Arg::PATH => 'foo']);

        $this->assertEquals('foo', $uri->path());
    }

    /**
     *
     */
    function test_query()
    {
        $uri = new Uri([Arg::QUERY => 'foo']);

        $this->assertEquals('foo', $uri->query());
    }

    /**
     *
     */
    function test_port()
    {
        $uri = new Uri([Arg::PORT => '80']);

        $this->assertEquals('80', $uri->port());
    }

    /**
     *
     */
    function test_scheme()
    {
        $uri = new Uri([Arg::SCHEME => 'http']);

        $this->assertEquals('http', $uri->scheme());
    }

    /**
     *
     */
    function test_user()
    {
        $uri = new Uri([Arg::USER => 'foo:bar']);

        $this->assertEquals('foo:bar', $uri->user());
    }

    /**
     *
     */
    function test_to_string()
    {
        $uri = new Uri([
            Arg::FRAGMENT => 'top',
            Arg::HOST     => 'localhost',
            Arg::PATH     => 'foobar',
            Arg::QUERY    => 'foo=bar',
            Arg::PORT     => '80',
            Arg::SCHEME   => 'http',
            Arg::USER     => 'user',
            Arg::PASS     => 'password'
        ]);

        $this->assertEquals('http://user:password@localhost/foobar?foo=bar#top', (string) $uri);
    }
}
